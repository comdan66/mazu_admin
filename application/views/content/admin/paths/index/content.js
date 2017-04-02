/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

window.gmc = function () { $(window).trigger ('gm'); };

$(function () {
  var _ks = [], _t = 1000 * 60, _vml = false, _lat = 23.569, _lng = 120.3038, _vm = null, _vp = null, _vz = null, _tr = null, _im = false;
  var $maps = $('#maps');
  var $select = $('#select').change (fsp);

  var _ps = {}, _p = [], _ms = [];

  function fsp (){
    _ms.forEach (function (t) { t.setMap (null); });

    _ms = _ps[$select.val ()].map (function (t, i) {

      var p = new google.maps.LatLng (t[0], t[1]);
      var m = new google.maps.Marker ({ map: _vm, position: p, draggable: true });

      m.addListener ('rightclick', function () {
        _ps[$select.val ()] = _ps[$select.val ()].slice (0, i).concat (_ps[$select.val ()].slice (i + 1, _ps[$select.val ()].length));
        fsp ();
      });
      m.addListener ('dblclick', function () {
        var t = _ps[$select.val ()][i];
        _ps[$select.val ()] = _ps[$select.val ()].slice (0, i).concat ([[t[0],t[1]]]).concat (_ps[$select.val ()].slice (i, _ps[$select.val ()].length));
        fsp ();
      });
      m.addListener ('dragend', function (e) {
        _ps[$select.val ()][i][0] = m.position.lat ();
        _ps[$select.val ()][i][1] = m.position.lng ();
        fsp ();
      });
      return m;
    });
    

    _vp.setPath (_ms.map (function (t) { return t.position; }));
  }
  function fin (){
    if (_vml) return ; _vml = true;
    
    function OAIN(e,t){function i(){}i.prototype=t.prototype,e.superClass_=t.prototype,e.prototype=new i,e.prototype.constructor=e}
    function OAML_(e,t,i){this.marker_=e,this.handCursorURL_=e.handCursorURL,this.labelDiv_=document.createElement("div"),this.labelDiv_.style.cssText="position: absolute; overflow: hidden;",this.eventDiv_=document.createElement("div"),this.eventDiv_.style.cssText=this.labelDiv_.style.cssText,this.eventDiv_.setAttribute("onselectstart","return false;"),this.eventDiv_.setAttribute("ondragstart","return false;"),this.crossDiv_=OAML_.getSharedCross(t)}
    function OAML (e) {e=e||{},e.labelContent=e.labelContent||"",e.initCallback=e.initCallback||function(){},e.labelAnchor=e.labelAnchor||new google.maps.Point(0,0),e.labelClass=e.labelClass||"markerLabels",e.labelStyle=e.labelStyle||{},e.labelInBackground=e.labelInBackground||!1,"undefined"==typeof e.labelVisible&&(e.labelVisible=!0),"undefined"==typeof e.raiseOnDrag&&(e.raiseOnDrag=!0),"undefined"==typeof e.clickable&&(e.clickable=!0),"undefined"==typeof e.draggable&&(e.draggable=!1),"undefined"==typeof e.optimized&&(e.optimized=!1),e.crossImage=e.crossImage||"http"+("https:"===document.location.protocol?"s":"")+"://maps.gstatic.com/intl/en_us/mapfiles/drag_cross_67_16.png",e.handCursor=e.handCursor||"http"+("https:"===document.location.protocol?"s":"")+"://maps.gstatic.com/intl/en_us/mapfiles/closedhand_8_8.cur",e.optimized=!1,this.label=new OAML_(this,e.crossImage,e.handCursor),google.maps.Marker.apply(this,arguments)}
    OAIN (OAML_,google.maps.OverlayView),OAML_.getSharedCross=function(e){var t;return"undefined"==typeof OAML_.getSharedCross.crossDiv&&(t=document.createElement("img"),t.style.cssText="position: absolute; z-index: 1000002; display: none;",t.style.marginLeft="-8px",t.style.marginTop="-9px",t.src=e,OAML_.getSharedCross.crossDiv=t),OAML_.getSharedCross.crossDiv},OAML_.prototype.onAdd=function(){var e,t,i,s,a,r,o,n=this,l=!1,g=!1,p=20,_="url("+this.handCursorURL_+")",v=function(e){e.preventDefault&&e.preventDefault(),e.cancelBubble=!0,e.stopPropagation&&e.stopPropagation()},h=function(){n.marker_.setAnimation(null)};this.getPanes().overlayImage.appendChild(this.labelDiv_),this.getPanes().overlayMouseTarget.appendChild(this.eventDiv_),"undefined"==typeof OAML_.getSharedCross.processed&&(this.getPanes().overlayImage.appendChild(this.crossDiv_),OAML_.getSharedCross.processed=!0),this.listeners_=[google.maps.event.addDomListener(this.eventDiv_,"mouseover",function(e){(n.marker_.getDraggable()||n.marker_.getClickable())&&(this.style.cursor="pointer",google.maps.event.trigger(n.marker_,"mouseover",e))}),google.maps.event.addDomListener(this.eventDiv_,"mouseout",function(e){!n.marker_.getDraggable()&&!n.marker_.getClickable()||g||(this.style.cursor=n.marker_.getCursor(),google.maps.event.trigger(n.marker_,"mouseout",e))}),google.maps.event.addDomListener(this.eventDiv_,"mousedown",function(e){g=!1,n.marker_.getDraggable()&&(l=!0,this.style.cursor=_),(n.marker_.getDraggable()||n.marker_.getClickable())&&(google.maps.event.trigger(n.marker_,"mousedown",e),v(e))}),google.maps.event.addDomListener(document,"mouseup",function(t){var i;if(l&&(l=!1,n.eventDiv_.style.cursor="pointer",google.maps.event.trigger(n.marker_,"mouseup",t)),g){if(a){i=n.getProjection().fromLatLngToDivPixel(n.marker_.getPosition()),i.y+=p,n.marker_.setPosition(n.getProjection().fromDivPixelToLatLng(i));try{n.marker_.setAnimation(google.maps.Animation.BOUNCE),setTimeout(h,1406)}catch(r){}}n.crossDiv_.style.display="none",n.marker_.setZIndex(e),s=!0,g=!1,t.latLng=n.marker_.getPosition(),google.maps.event.trigger(n.marker_,"dragend",t)}}),google.maps.event.addListener(n.marker_.getMap(),"mousemove",function(s){var _;l&&(g?(s.latLng=new google.maps.LatLng(s.latLng.lat()-t,s.latLng.lng()-i),_=n.getProjection().fromLatLngToDivPixel(s.latLng),a&&(n.crossDiv_.style.left=_.x+"px",n.crossDiv_.style.top=_.y+"px",n.crossDiv_.style.display="",_.y-=p),n.marker_.setPosition(n.getProjection().fromDivPixelToLatLng(_)),a&&(n.eventDiv_.style.top=_.y+p+"px"),google.maps.event.trigger(n.marker_,"drag",s)):(t=s.latLng.lat()-n.marker_.getPosition().lat(),i=s.latLng.lng()-n.marker_.getPosition().lng(),e=n.marker_.getZIndex(),r=n.marker_.getPosition(),o=n.marker_.getMap().getCenter(),a=n.marker_.get("raiseOnDrag"),g=!0,n.marker_.setZIndex(1e6),s.latLng=n.marker_.getPosition(),google.maps.event.trigger(n.marker_,"dragstart",s)))}),google.maps.event.addDomListener(document,"keydown",function(e){g&&27===e.keyCode&&(a=!1,n.marker_.setPosition(r),n.marker_.getMap().setCenter(o),google.maps.event.trigger(document,"mouseup",e))}),google.maps.event.addDomListener(this.eventDiv_,"click",function(e){(n.marker_.getDraggable()||n.marker_.getClickable())&&(s?s=!1:(google.maps.event.trigger(n.marker_,"click",e),v(e)))}),google.maps.event.addDomListener(this.eventDiv_,"dblclick",function(e){(n.marker_.getDraggable()||n.marker_.getClickable())&&(google.maps.event.trigger(n.marker_,"dblclick",e),v(e))}),google.maps.event.addListener(this.marker_,"dragstart",function(e){g||(a=this.get("raiseOnDrag"))}),google.maps.event.addListener(this.marker_,"drag",function(e){g||a&&(n.setPosition(p),n.labelDiv_.style.zIndex=1e6+(this.get("labelInBackground")?-1:1))}),google.maps.event.addListener(this.marker_,"dragend",function(e){g||a&&n.setPosition(0)}),google.maps.event.addListener(this.marker_,"position_changed",function(){n.setPosition()}),google.maps.event.addListener(this.marker_,"zindex_changed",function(){n.setZIndex()}),google.maps.event.addListener(this.marker_,"visible_changed",function(){n.setVisible()}),google.maps.event.addListener(this.marker_,"labelvisible_changed",function(){n.setVisible()}),google.maps.event.addListener(this.marker_,"title_changed",function(){n.setTitle()}),google.maps.event.addListener(this.marker_,"labelcontent_changed",function(){n.setContent()}),google.maps.event.addListener(this.marker_,"labelanchor_changed",function(){n.setAnchor()}),google.maps.event.addListener(this.marker_,"labelclass_changed",function(){n.setStyles()}),google.maps.event.addListener(this.marker_,"labelstyle_changed",function(){n.setStyles()})]},OAML_.prototype.onRemove=function(){var e;for(this.labelDiv_.parentNode.removeChild(this.labelDiv_),this.eventDiv_.parentNode.removeChild(this.eventDiv_),e=0;e<this.listeners_.length;e++)google.maps.event.removeListener(this.listeners_[e])},OAML_.prototype.draw=function(){this.setContent(),this.setTitle(),this.setStyles()},OAML_.prototype.setContent=function(){var e=this.marker_.get("labelContent");"undefined"==typeof e.nodeType?(this.labelDiv_.innerHTML=e,this.eventDiv_.innerHTML=this.labelDiv_.innerHTML):(this.labelDiv_.innerHTML="",this.labelDiv_.appendChild(e),e=e.cloneNode(!0),this.eventDiv_.innerHTML="",this.eventDiv_.appendChild(e))},OAML_.prototype.setTitle=function(){this.eventDiv_.title=this.marker_.getTitle()||""},OAML_.prototype.setStyles=function(){var e,t;this.labelDiv_.className=this.marker_.get("labelClass"),this.eventDiv_.className=this.labelDiv_.className,this.labelDiv_.style.cssText="",this.eventDiv_.style.cssText="",t=this.marker_.get("labelStyle");for(e in t)t.hasOwnProperty(e)&&(this.labelDiv_.style[e]=t[e],this.eventDiv_.style[e]=t[e]);this.setMandatoryStyles()},OAML_.prototype.setMandatoryStyles=function(){this.labelDiv_.style.position="absolute",this.labelDiv_.style.overflow="","undefined"!=typeof this.labelDiv_.style.opacity&&""!==this.labelDiv_.style.opacity&&(this.labelDiv_.style.MsFilter='"progid:DXImageTransform.Microsoft.Alpha(opacity='+100*this.labelDiv_.style.opacity+')"',this.labelDiv_.style.filter="alpha(opacity="+100*this.labelDiv_.style.opacity+")"),this.eventDiv_.style.position=this.labelDiv_.style.position,this.eventDiv_.style.overflow=this.labelDiv_.style.overflow,this.eventDiv_.style.opacity=.01,this.eventDiv_.style.MsFilter='"progid:DXImageTransform.Microsoft.Alpha(opacity=1)"',this.eventDiv_.style.filter="alpha(opacity=1)",this.setAnchor(),this.setPosition(),this.setVisible()},OAML_.prototype.setAnchor=function(){var e=this.marker_.get("labelAnchor");this.labelDiv_.style.marginLeft=-e.x+"px",this.labelDiv_.style.marginTop=-e.y+"px",this.eventDiv_.style.marginLeft=-e.x+"px",this.eventDiv_.style.marginTop=-e.y+"px"},OAML_.prototype.setPosition=function(e){var t=this.getProjection().fromLatLngToDivPixel(this.marker_.getPosition());"undefined"==typeof e&&(e=0),this.labelDiv_.style.left=Math.round(t.x)+"px",this.labelDiv_.style.top=Math.round(t.y-e)+"px",this.eventDiv_.style.left=this.labelDiv_.style.left,this.eventDiv_.style.top=this.labelDiv_.style.top,this.setZIndex()},OAML_.prototype.setZIndex=function(){var e=this.marker_.get("labelInBackground")?-1:1;"undefined"==typeof this.marker_.getZIndex()?(this.labelDiv_.style.zIndex=parseInt(this.labelDiv_.style.top,10)+e,this.eventDiv_.style.zIndex=this.labelDiv_.style.zIndex):(this.labelDiv_.style.zIndex=this.marker_.getZIndex()+e,this.eventDiv_.style.zIndex=this.labelDiv_.style.zIndex)},OAML_.prototype.setVisible=function(){this.marker_.get("labelVisible")?this.labelDiv_.style.display=this.marker_.getVisible()?"block":"none":this.labelDiv_.style.display="none",this.eventDiv_.style.display=this.labelDiv_.style.display;var e=this.marker_.get("initCallback");e(this.labelDiv_)},OAIN(OAML,google.maps.Marker),OAML.prototype.setMap=function(e){google.maps.Marker.prototype.setMap.apply(this,arguments),this.label.setMap(e)};

    var p = new google.maps.LatLng (_lat, _lng);
    _vm = new google.maps.Map ($maps.get (0), { zoom: 16, disableDefaultUI: true, center: p });
    _vm.mapTypes.set ('style1', new google.maps.StyledMapType ([{featureType: 'administrative.land_parcel', elementType: 'labels', stylers: [{visibility: 'on'}]}, {featureType: 'poi', elementType: 'labels.text', stylers: [{visibility: 'off'}]}, {featureType: 'poi.business', stylers: [{visibility: 'on'}]}, {featureType: 'poi.park', elementType: 'labels.text', stylers: [{visibility: 'on'}]}, {featureType: 'road.local', elementType: 'labels', stylers: [{visibility: 'on'}]}]));
    _vm.setMapTypeId ('style1');
    _vm.addListener ('click', function (e) { console.error (e.latLng.lat (), e.latLng.lng ()); });
    $('#z').find ('a').click (function () { _vm.setZoom (_vm.zoom + ($(this).index () ? -1 : 1)); });
    $('#zoom').click (function () {
      $('#maps_panel').toggleClass ('fix');
    });
    $('#log').click (function () {

      $.post ($maps.data ('url'), {
          type: $select.val (),
          points: '[' + _ps[$select.val ()].map (function (t) {
            return '[' + t[0] + ',' + t[1] +']';
          }).join (',') + ']'
      }, function (r) {
        alert (r);
        
      }).fail (function (r) {
        alert (JSON.parse (r.responseText).message);
      });
    });

    _ps = $maps.data ('paths');
    for (var i in _ps) _ps[i] = _ps[i].map (function (t) { return [t[0], t[1]]; })
    _vp = new google.maps.Polyline ({ map: _vm, strokeColor: 'rgba(255, 3, 0, .5)', strokeWeight: 4 });
    
    fsp ();
  }
  function flgm (){
    var k = _ks[Math.floor ((Math.random() * _ks.length))], s = document.createElement ('script');
    s.setAttribute ('type', 'text/javascript');
    s.setAttribute ('src', 'https://maps.googleapis.com/maps/api/js?' + (k ? 'key=' + k + '&' : '') + 'language=zh-TW&libraries=visualization&callback=gmc');
    (document.getElementsByTagName ('head')[0] || document.documentElement).appendChild (s);
    s.onload = fin;
  }
  $(window).bind ('gm', fin);
  flgm ();
});