/* Leaflet Export to JSON */
L.Control.ExportJSON = L.Control.extend({
  options: {
    position: "topright",
    exportJsonText: "Export GeoJSON",
    exportJsonTitle: "Export GeoJSON",
    forceSeparateButtton: false
  },
  initialize: function (map, options) {
        this._map = map;
        L.Util.setOptions(this, options);    
    },

  onAdd: function (map) {
    var exportName = "leaflet-control-fullscreen";
    //var container = L.DomUtil.create("div", exportName + " leaflet-bar leaflet-control")

    var container;
      if (map.fullscreenControl && !this.options.forceSeparateButton) {
          container = map.fullscreenControl._container;
      } else {
          container = L.DomUtil.create('div', exportName +' leaflet-bar leaflet-control');
      }
    //var options = this.options;

    //this._map = map;

    this._exportJsonButton = this._createButton (
      this.options.exportJsonText, 
      this.options.exportJsonTitle, 
      'leaflet-control-export', 
      container, 
      this._exportJson, 
      this
    );
    return container;
  },
  _createButton: function (html, title, className, container, fn, context) {
    var link = L.DomUtil.create('a', className, container);
    link.innerHTML = html;
    link.href = '#';
    link.title = title;

    var stop = L.DomEvent.stopPropagation;

    L.DomEvent
      .on(link, 'click', stop)
      .on(link, 'mousedown', stop)
      .on(link, 'dblclick', stop)
      .on(link, 'click', L.DomEvent.preventDefault)
      .on(link, 'click', fn, context);

    return link;
  }, 

  _exportJson: function () {
    //if(drawnItems.getLayers().length != 0) {
      var geoData = [];     

      for (var i in drawnItems._layers) {
          var tmpjson = drawnItems._layers[i].toGeoJSON();          
          geoData.push(tmpjson);
      }
      console.log(JSON.stringify(geoData));
      var fileJSON = JSON.stringify(geoData);
      var authorID = $("#authorId").val();
      $.ajax({
        type: "post",
        url: "../editor/server/php/exportJSON.php",
        data: {fileGeoJSON: fileJSON, fileName: fileGeoJson, author: authorID },
        success: function(data) {
          //console.log(data);
        	$('.top-right').notify({
           		message : {
                	text : data
                	},
            	type : 'success',
                fadeOut : {
                    delay: 5000
                }
            }).show();
          pageContentChange = 0;
          //window.location.reload();
        },
        error: function(data) {
          //console.log(data);
          $('.top-right').notify({
           		message : {
                	text : data
                	},
            	type : 'danger',
                fadeOut : {
                    delay: 5000
                }
            }).show();
        }
      });
    // }
    // else {
    //     console.log("empty layer");
    //     alert("empty layer");
    // }
  }
  
});

/* Leaflet MiniMap*/
L.Control.MiniMap = L.Control.extend({
  options: {
    position: 'bottomright',
    toggleDisplay: false,
    zoomLevelOffset: -5,
    zoomLevelFixed: false,
    zoomAnimation: false,
    autoToggleDisplay: false,
    width: 150,
    height: 150,
    aimingRectOptions: {color: "#ff7800", weight: 1, clickable: false},
    shadowRectOptions: {color: "#000000", weight: 1, clickable: false, opacity:0, fillOpacity:0}
  },
  
  hideText: 'Hide MiniMap',
  
  showText: 'Show MiniMap',
  
  //layer is the map layer to be shown in the minimap
  initialize: function (layer, options) {
    L.Util.setOptions(this, options);
    //Make sure the aiming rects are non-clickable even if the user tries to set them clickable (most likely by forgetting to specify them false)
    this.options.aimingRectOptions.clickable = false;
    this.options.shadowRectOptions.clickable = false;
    this._layer = layer;
  },
  
  onAdd: function (map) {

    this._mainMap = map;

    //Creating the container and stopping events from spilling through to the main map.
    this._container = L.DomUtil.create('div', 'leaflet-control-minimap');
    this._container.style.width = this.options.width + 'px';
    this._container.style.height = this.options.height + 'px';
    L.DomEvent.disableClickPropagation(this._container);
    L.DomEvent.on(this._container, 'mousewheel', L.DomEvent.stopPropagation);


    this._miniMap = new L.Map(this._container,
    {
      attributionControl: false,
      zoomControl: false,
      zoomAnimation: this.options.zoomAnimation,
      autoToggleDisplay: this.options.autoToggleDisplay,
      touchZoom: !this.options.zoomLevelFixed,
      scrollWheelZoom: !this.options.zoomLevelFixed,
      doubleClickZoom: !this.options.zoomLevelFixed,
      boxZoom: !this.options.zoomLevelFixed,
      crs: map.options.crs
    });

    this._miniMap.addLayer(this._layer);

    //These bools are used to prevent infinite loops of the two maps notifying each other that they've moved.
    this._mainMapMoving = false;
    this._miniMapMoving = false;

    //Keep a record of this to prevent auto toggling when the user explicitly doesn't want it.
    this._userToggledDisplay = false;
    this._minimized = false;

    if (this.options.toggleDisplay) {
      this._addToggleButton();
    }

    this._miniMap.whenReady(L.Util.bind(function () {
      this._aimingRect = L.rectangle(this._mainMap.getBounds(), this.options.aimingRectOptions).addTo(this._miniMap);
      this._shadowRect = L.rectangle(this._mainMap.getBounds(), this.options.shadowRectOptions).addTo(this._miniMap);
      this._mainMap.on('moveend', this._onMainMapMoved, this);
      this._mainMap.on('move', this._onMainMapMoving, this);
      this._miniMap.on('movestart', this._onMiniMapMoveStarted, this);
      this._miniMap.on('move', this._onMiniMapMoving, this);
      this._miniMap.on('moveend', this._onMiniMapMoved, this);
    }, this));

    return this._container;
  },

  addTo: function (map) {
    L.Control.prototype.addTo.call(this, map);
    this._miniMap.setView(this._mainMap.getCenter(), this._decideZoom(true));
    this._setDisplay(this._decideMinimized());
    return this;
  },

  onRemove: function (map) {
    this._mainMap.off('moveend', this._onMainMapMoved, this);
    this._mainMap.off('move', this._onMainMapMoving, this);
    this._miniMap.off('moveend', this._onMiniMapMoved, this);

    this._miniMap.removeLayer(this._layer);
  },

  _addToggleButton: function () {
    this._toggleDisplayButton = this.options.toggleDisplay ? this._createButton(
        '', this.hideText, 'leaflet-control-minimap-toggle-display', this._container, this._toggleDisplayButtonClicked, this) : undefined;
  },

  _createButton: function (html, title, className, container, fn, context) {
    var link = L.DomUtil.create('a', className, container);
    link.innerHTML = html;
    link.href = '#';
    link.title = title;

    var stop = L.DomEvent.stopPropagation;

    L.DomEvent
      .on(link, 'click', stop)
      .on(link, 'mousedown', stop)
      .on(link, 'dblclick', stop)
      .on(link, 'click', L.DomEvent.preventDefault)
      .on(link, 'click', fn, context);

    return link;
  },

  _toggleDisplayButtonClicked: function () {
    this._userToggledDisplay = true;
    if (!this._minimized) {
      this._minimize();
      this._toggleDisplayButton.title = this.showText;
    }
    else {
      this._restore();
      this._toggleDisplayButton.title = this.hideText;
    }
  },

  _setDisplay: function (minimize) {
    if (minimize != this._minimized) {
      if (!this._minimized) {
        this._minimize();
      }
      else {
        this._restore();
      }
    }
  },

  _minimize: function () {
    // hide the minimap
    if (this.options.toggleDisplay) {
      this._container.style.width = '24px';
      this._container.style.height = '24px';
      this._toggleDisplayButton.className += ' minimized';
    }
    else {
      this._container.style.display = 'none';
    }
    this._minimized = true;
  },

  _restore: function () {
    if (this.options.toggleDisplay) {
      this._container.style.width = this.options.width + 'px';
      this._container.style.height = this.options.height + 'px';
      this._toggleDisplayButton.className = this._toggleDisplayButton.className
          .replace(/(?:^|\s)minimized(?!\S)/g, '');
    }
    else {
      this._container.style.display = 'block';
    }
    this._minimized = false;
  },

  _onMainMapMoved: function (e) {
    if (!this._miniMapMoving) {
      this._mainMapMoving = true;
      this._miniMap.setView(this._mainMap.getCenter(), this._decideZoom(true));
      this._setDisplay(this._decideMinimized());
    } else {
      this._miniMapMoving = false;
    }
    this._aimingRect.setBounds(this._mainMap.getBounds());
  },

  _onMainMapMoving: function (e) {
    this._aimingRect.setBounds(this._mainMap.getBounds());
  },

  _onMiniMapMoveStarted:function (e) {
    var lastAimingRect = this._aimingRect.getBounds();
    var sw = this._miniMap.latLngToContainerPoint(lastAimingRect.getSouthWest());
    var ne = this._miniMap.latLngToContainerPoint(lastAimingRect.getNorthEast());
    this._lastAimingRectPosition = {sw:sw,ne:ne};
  },

  _onMiniMapMoving: function (e) {
    if (!this._mainMapMoving && this._lastAimingRectPosition) {
      this._shadowRect.setBounds(new L.LatLngBounds(this._miniMap.containerPointToLatLng(this._lastAimingRectPosition.sw),this._miniMap.containerPointToLatLng(this._lastAimingRectPosition.ne)));
      this._shadowRect.setStyle({opacity:1,fillOpacity:0.3});
    }
  },

  _onMiniMapMoved: function (e) {
    if (!this._mainMapMoving) {
      this._miniMapMoving = true;
      this._mainMap.setView(this._miniMap.getCenter(), this._decideZoom(false));
      this._shadowRect.setStyle({opacity:0,fillOpacity:0});
    } else {
      this._mainMapMoving = false;
    }
  },

  _decideZoom: function (fromMaintoMini) {
    if (!this.options.zoomLevelFixed) {
      if (fromMaintoMini)
        return this._mainMap.getZoom() + this.options.zoomLevelOffset;
      else {
        var currentDiff = this._miniMap.getZoom() - this._mainMap.getZoom();
        var proposedZoom = this._miniMap.getZoom() - this.options.zoomLevelOffset;
        var toRet;
        
        if (currentDiff > this.options.zoomLevelOffset && this._mainMap.getZoom() < this._miniMap.getMinZoom() - this.options.zoomLevelOffset) {
          //This means the miniMap is zoomed out to the minimum zoom level and can't zoom any more.
          if (this._miniMap.getZoom() > this._lastMiniMapZoom) {
            //This means the user is trying to zoom in by using the minimap, zoom the main map.
            toRet = this._mainMap.getZoom() + 1;
            //Also we cheat and zoom the minimap out again to keep it visually consistent.
            this._miniMap.setZoom(this._miniMap.getZoom() -1);
          } else {
            //Either the user is trying to zoom out past the mini map's min zoom or has just panned using it, we can't tell the difference.
            //Therefore, we ignore it!
            toRet = this._mainMap.getZoom();
          }
        } else {
          //This is what happens in the majority of cases, and always if you configure the min levels + offset in a sane fashion.
          toRet = proposedZoom;
        }
        this._lastMiniMapZoom = this._miniMap.getZoom();
        return toRet;
      }
    } else {
      if (fromMaintoMini)
        return this.options.zoomLevelFixed;
      else
        return this._mainMap.getZoom();
    }
  },

  _decideMinimized: function () {
    if (this._userToggledDisplay) {
      return this._minimized;
    }

    if (this.options.autoToggleDisplay) {
      if (this._mainMap.getBounds().contains(this._miniMap.getBounds())) {
        return true;
      }
      return false;
    }

    return this._minimized;
  }
});

L.Map.mergeOptions({
  miniMapControl: false
});

L.Map.addInitHook(function () {
  if (this.options.miniMapControl) {
    this.miniMapControl = (new L.Control.MiniMap()).addTo(this);
  }
});

L.control.minimap = function (options) {
  return new L.Control.MiniMap(options);
};


/*Leaflet FullScreen */
L.Control.Fullscreen = L.Control.extend({
    options: {
        position: 'topright',
        title: {
            false: 'View Fullscreen',
            true: 'Exit Fullscreen'
        },
        forceSeparateButton: false
    },

    onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control-fullscreen leaflet-bar leaflet-control');
        // var container;
        // if (map.zoomControl && !this.options.forceSeparateButton) {
        //     container = map.zoomControl._container;
        // } else {
        //     container = L.DomUtil.create('div', 'leaflet-control-fullscreen leaflet-bar leaflet-control');
        // }

        this.link = L.DomUtil.create('a', 'leaflet-control-fullscreen-button leaflet-bar-part', container);
        this.link.href = '#';

        this._map = map;
        this._map.on('fullscreenchange', this._toggleTitle, this);
        this._toggleTitle();

        L.DomEvent.on(this.link, 'click', this._click, this);

        return container;
    },

    _click: function (e) {
        L.DomEvent.stopPropagation(e);
        L.DomEvent.preventDefault(e);
        this._map.toggleFullscreen();
    },

    _toggleTitle: function() {
        this.link.title = this.options.title[this._map.isFullscreen()];
    }
});

L.Map.include({
    isFullscreen: function () {
        return this._isFullscreen || false;
    },

    toggleFullscreen: function () {
        var container = this.getContainer();
        if (this.isFullscreen()) {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } else {
                L.DomUtil.removeClass(container, 'leaflet-pseudo-fullscreen');
                this._toggleFullscreenClass();
                this.invalidateSize();
                this._isFullscreen = false;
                this.fire('fullscreenchange');
            }
        } else {
            if (container.requestFullscreen) {
                container.requestFullscreen();
            } else if (container.mozRequestFullScreen) {
                container.mozRequestFullScreen();
            } else if (container.webkitRequestFullscreen) {
                container.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            } else {
                L.DomUtil.addClass(container, 'leaflet-pseudo-fullscreen');
                this._toggleFullscreenClass();
                this.invalidateSize();
                this._isFullscreen = true;
                this.fire('fullscreenchange');
            }
        }
    },

    _toggleFullscreenClass: function() {
        var container = this.getContainer();
        if (this.isFullscreen()) {
            L.DomUtil.removeClass(container, 'leaflet-fullscreen-on');
        } else {
            L.DomUtil.addClass(container, 'leaflet-fullscreen-on');
        }
    },

    _onFullscreenChange: function () {
        var fullscreenElement =
            document.fullscreenElement ||
            document.mozFullScreenElement ||
            document.webkitFullscreenElement;

        this._toggleFullscreenClass();
        if (fullscreenElement === this.getContainer()) {
            this._isFullscreen = true;
            this.fire('fullscreenchange');
        } else if (this._isFullscreen) {
            this._isFullscreen = false;
            this.fire('fullscreenchange');
        }
    }
});

L.Map.mergeOptions({
    fullscreenControl: false
});

L.Map.addInitHook(function () {
    if (this.options.fullscreenControl) {
        this.fullscreenControl = new L.Control.Fullscreen();
        this.addControl(this.fullscreenControl);
    }

    var fullscreenchange;

    if ('onfullscreenchange' in document) {
        fullscreenchange = 'fullscreenchange';
    } else if ('onmozfullscreenchange' in document) {
        fullscreenchange = 'mozfullscreenchange';
    } else if ('onwebkitfullscreenchange' in document) {
        fullscreenchange = 'webkitfullscreenchange';
    }

    if (fullscreenchange) {
        this.whenReady(function () {
            L.DomEvent.on(document, fullscreenchange, this._onFullscreenChange, this);
        });

        this.on('unload', function () {
            L.DomEvent.off(document, fullscreenchange, this._onFullscreenChange);
        });
    }
});

L.control.fullscreen = function (options) {
    return new L.Control.Fullscreen(options);
};

/*
  Leaflet.AwesomeMarkers, a plugin that adds colorful iconic markers for Leaflet, based on the Font Awesome icons
  (c) 2012-2013, Lennard Voogdt

  http://leafletjs.com
  https://github.com/lvoogdt
*/

/*global L*/

(function (window, document, undefined) {
    "use strict";
    /*
     * Leaflet.AwesomeMarkers assumes that you have already included the Leaflet library.
     */

    L.AwesomeMarkers = {};

    L.AwesomeMarkers.version = '2.0.1';

    L.AwesomeMarkers.Icon = L.Icon.extend({
        options: {
            iconSize: [35, 45],
            iconAnchor:   [17, 42],
            popupAnchor: [1, -32],
            shadowAnchor: [10, 12],
            shadowSize: [36, 16],
            className: 'awesome-marker',
            prefix: 'fa',
            spinClass: 'fa-spin',
            extraClasses: '',
            icon: 'home',
            markerColor: 'blue',
            iconColor: 'white'
        },

        initialize: function (options) {
            options = L.Util.setOptions(this, options);
        },

        createIcon: function () {
            var div = document.createElement('div'),
                options = this.options;

            if (options.icon) {
                div.innerHTML = this._createInner();
            }

            if (options.bgPos) {
                div.style.backgroundPosition =
                    (-options.bgPos.x) + 'px ' + (-options.bgPos.y) + 'px';
            }

            this._setIconStyles(div, 'icon-' + options.markerColor);
            return div;
        },

        _createInner: function() {
            var iconClass, iconSpinClass = "", iconColorClass = "", iconColorStyle = "", options = this.options;

            if(options.icon.slice(0,options.prefix.length+1) === options.prefix + "-") {
                iconClass = options.icon;
            } else {
                iconClass = options.prefix + "-" + options.icon;
            }

            if(options.spin && typeof options.spinClass === "string") {
                iconSpinClass = options.spinClass;
            }

            if(options.iconColor) {
                if(options.iconColor === 'white' || options.iconColor === 'black') {
                    iconColorClass = "icon-" + options.iconColor;
                } else {
                    iconColorStyle = "style='color: " + options.iconColor + "' ";
                }
            }

            return "<i " + iconColorStyle + "class='" + options.extraClasses + " " + options.prefix + " " + iconClass + " " + iconSpinClass + " " + iconColorClass + "'></i>";
        },

        _setIconStyles: function (img, name) {
            var options = this.options,
                size = L.point(options[name === 'shadow' ? 'shadowSize' : 'iconSize']),
                anchor;

            if (name === 'shadow') {
                anchor = L.point(options.shadowAnchor || options.iconAnchor);
            } else {
                anchor = L.point(options.iconAnchor);
            }

            if (!anchor && size) {
                anchor = size.divideBy(2, true);
            }

            img.className = 'awesome-marker-' + name + ' ' + options.className;

            if (anchor) {
                img.style.marginLeft = (-anchor.x) + 'px';
                img.style.marginTop  = (-anchor.y) + 'px';
            }

            if (size) {
                img.style.width  = size.x + 'px';
                img.style.height = size.y + 'px';
            }
        },

        createShadow: function () {
            var div = document.createElement('div');

            this._setIconStyles(div, 'shadow');
            return div;
      }
    });
        
    L.AwesomeMarkers.icon = function (options) {
        return new L.AwesomeMarkers.Icon(options);
    };

}(this, document));



