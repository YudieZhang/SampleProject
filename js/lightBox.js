;(function($){

  var lightBox = function(setting){

    var self = this;
    this.obj = $('.js-lightBox') ;
    this.setting = setting;
    this.defaultSetting = {
      speed:'fast',
      scale: 0.8
    }
    $.extend(this.defaultSetting,this.getCustomSetting());
    this.groupArr = [];
    this.clear = false;
    this.groupName = null;
    this.bodyNode = $(document.body);
    this.popupMask = $("<div class='lightBox-popupMask'></div>");
    this.popup     = $("<div class='lightBox-popup'></div>");
    this.settingDefaultImg();

    this.obj.on('click',  function(event) {
      event.preventDefault();
      event.stopPropagation();
      var currentGroup = $(this).attr('data-group');
      if(currentGroup != self.groupName){
        self.groupName = currentGroup;
      }
      self.defaultDOM();

      self.getImageGroup();

      self.initLightBox($(this));

    });
  };

  lightBox.prototype = {
    getCustomSetting : function(){
        var setting = this.setting ;
        if(setting && setting != ''){
            return setting;
        }else{
            return {};
        }
    },
    settingDefaultImg : function (){
      var obj = this.obj;
      obj.each(function(i){obj.eq(i).attr('data-id',i)});
    },
    goto : function(dir){
      var len = this.groupArr.length;
      if(dir==='prev'){
        var picSrc = this.groupArr[--this.index].src;
        this.loadCompletePicShow(picSrc);            
      }else{
        var picSrc = this.groupArr[++this.index].src;
        this.loadCompletePicShow(picSrc);
      }
    },
    showMaskAndPopu:function(src,id){
      var _this_ = this 
          _scale_ = 1 ;
      this.winWidth  = $(window).width();
      this.winHeight = $(window).height();
      this.lightBoxPic.hide();
      this.lightBoxDescription.hide();
      this.lightBoxPopupMask.fadeIn();
      this.lightPopup.fadeIn();

      this.lightPopup.css({
        "width"      : this.winWidth/4 ,
        "height"     : this.winHeight/4 ,
        "marginLeft" : -(this.winWidth/4) / 2 ,
        "marginTop"  : -this.lightPopup.height() - 8 ,
      }).animate({
        "marginTop"  : (this.winHeight-this.lightPopup.height() + 8)/2 
      },this.defaultSetting.speed,function(){
        _this_.loadCompletePicShow(_this_.src);
      })

    },
    settingParmt : function(thisObj){
      this.src   = thisObj.attr('src');
      this.title = thisObj.attr('data-title');
      this.lightBoxPic.attr('src',this.src);
    },
    getCurrentIndex : function(thisObj){
      var thisID = thisObj.attr('data-id'),
          index = 0;
      jQuery.each(this.groupArr,function(i,e){
        if(thisID == e.id){
          index = i;
          return false;
        }
      });
      return index;
    },
    loadPicShow : function(thisSrc,callback){
      var image = new Image();
      if(!!window.ActiveXObject){
        //IE
        image.onreadystatechange = function(){
          if(this.readyState == "complete"){
            callback();
          }
        };
      }else{
        image.onload = function(){
            callback();
        };
      }
      image.src = thisSrc;
    },
    loadCompletePicShow : function (src){
      var _this_ = this ;
      this.lightBoxPic.css({"width":"auto","height":"auto"}).hide();
      //this.lightBoxDescription.hide();
      this.winWidth  = $(window).width();
      this.winHeight = $(window).height();
      this.clear = true;

      _this_.loadPicShow(src,function(){
        _this_.lightBoxPic.attr('src',src); 
        var picWidth  = _this_.lightBoxPic.width();
        var picHeight = _this_.lightBoxPic.height();

        var groupArrLength = _this_.groupArr.length;
        if( groupArrLength>1 ){
          if(_this_.index === 0){
            _this_.lightBoxPrevBtn.addClass('disable');
            _this_.lightBoxNextBtn.removeClass('disable');
          }else if(_this_.index === groupArrLength-1){
            _this_.lightBoxNextBtn.addClass('disable');
            _this_.lightBoxPrevBtn.removeClass('disable');
          }else{
            _this_.lightBoxNextBtn.removeClass('disable');
            _this_.lightBoxPrevBtn.removeClass('disable');
          }
        }

        if(picWidth > _this_.winWidth || picHeight > _this_.winHeight){
          _scale_ = Math.min(_this_.winWidth/(picWidth+12) * _this_.defaultSetting.scale , _this_.winHeight/(picHeight+12)* _this_.defaultSetting.scale);
        }else{
          _scale_ =  _this_.defaultSetting.scale;   
        }

        picWidth = picWidth * _scale_;
        picHeight = picHeight * _scale_; 
        _this_.lightPopup.animate({
          "width"      : picWidth*3  -12 ,
          "height"     : picHeight*3  -12 ,      
          "marginLeft" : -picWidth*3  / 2 ,
          "marginTop"  : (_this_.winHeight - picHeight*3 ) /2 ,
        },function(){
          _this_.lightBoxPic.css({
            "width"      : picWidth*3  -12 ,
            "height"     : picHeight*3  -12 ,                
          });

          _this_.lightBoxTitle.text(_this_.groupArr[_this_.index].title);
          _this_.lightBoxCurrentIndex.text( (_this_.index + 1 ) + ' of ' + _this_.groupArr.length );
          _this_.lightBoxPic.fadeIn();
          _this_.lightBoxDescription.fadeIn(); 

        });

      });
    },
    initLightBox:function(thisObj){
          var _this_    = this ,
          sourceSrc = thisObj.attr('src'),
          currentID = thisObj.attr('data-id');
          this.left = thisObj.offset().left ;
          this.top  = thisObj.offset().top ;
          this.width = thisObj.width() ;
          this.height = thisObj.height() ;

          this.settingParmt(thisObj);
          this.showMaskAndPopu(sourceSrc,currentID);   
          this.index = this.getCurrentIndex(thisObj); 
    },
    defaultDOM : function(){
      var _this_     = this ;
      var _leftBtn_  = '<span class="lightBox-btn lightBox-prev-btn active"></span>',
          _rightBtn_ = '<span class="lightBox-btn lightBox-next-btn active"></span>',
          _btn_ = $('<div class="btn-position">').append(_leftBtn_,_rightBtn_);

      this.lightBoxView = '<div class="lightBox-view">'+
                            '<div class="lightBox-pic">'+
                              '<img src="" >'+
                            '</div>'+
                            '<div class="lightBox-description">'+
                              '<span class="lightBox-close"></span>'+
                              '<p class="lightBox-title"></p>'+
                              '<small class="lightBox-current-index"></small>'+
                            '</div>'+
                          '</div>'; 
                          
      this.bodyNode.prepend(this.popupMask,this.popup);
      this.popup.html('').append(this.lightBoxView);

      this.lightBoxPopupMask = this.bodyNode.find('.lightBox-popupMask');
      this.lightPopup = this.bodyNode.find('.lightBox-popup');
      this.lightBoxPic = this.lightPopup.find('.lightBox-pic > img');
      this.lightBoxClose   = this.lightPopup.find('.lightBox-close');
      this.lightBoxTitle   = this.lightPopup.find('.lightBox-title');
      this.lightBoxCurrentIndex = this.lightPopup.find('.lightBox-current-index');
      this.lightBoxDescription = this.lightPopup.find('.lightBox-description');
      this.lightBoxDescription.find('.lightBox-close').after(_btn_);
      this.lightBoxPrevBtn = this.lightPopup.find('.lightBox-prev-btn');
      this.lightBoxNextBtn = this.lightPopup.find('.lightBox-next-btn');   

      this.lightBoxPopupMask.on('click',function(event){
        event.preventDefault();
        event.stopPropagation();
        $(this).fadeOut();
        _this_.lightPopup.fadeOut();
        _this_.clear = false;
      });

      this.lightBoxClose.on('click',function(event){
        event.preventDefault();
        event.stopPropagation();
        _this_.lightPopup.fadeOut();
        _this_.lightBoxPopupMask.fadeOut();
        _this_.clear = false;
      });

      this.lightBoxPrevBtn.on('click',function(event){
          if(!$(this).hasClass('disable')){ 
            event.preventDefault();
            event.stopPropagation();
            _this_.goto('prev') 
          }
      })

      var timer = null;
      $(window).resize(function(event) {
        /* Act on the event */
        if(_this_.clear){
          clearTimeout(timer);
          timer = setTimeout(function(){
            _this_.loadCompletePicShow(_this_.groupArr[_this_.index].src);  
          },500)          
        }

      });
      document.onkeyup = function(e) {
        e = (e) ? e : window.event;
        if(e.key === "ArrowLeft" || e.keyCode === 37 ){
          _this_.lightBoxPrevBtn.click();
        }else if(e.key === "ArrowRight" || e.keyCode === 39){
          _this_.lightBoxNextBtn.click();
        }
      };
      this.lightBoxNextBtn.on('click',function(event){
          if(!$(this).hasClass('disable')){ 
            event.preventDefault();
            event.stopPropagation();
            _this_.goto('next') 
          }
      })
    },
    getImageGroup : function(){
      var _this_ = this ;
          _this_.groupArr = [];
      this.bodyNode.find("[data-group='"+ this.groupName +"']").each(function(index, el) {

        _this_.groupArr.push({
          "src":$(el).attr('src'),
          "title":$(el).attr('data-title'),
          "id":$(el).attr('data-id'),
          "group":$(el).attr('data-group'),
          "src":$(el).attr('src')
        });

      })
    },     
  };
  $.extend({
    LightBox :function(object){
      new lightBox(object);    
    } 
  });
  
  window['lightBox'] = lightBox;

})(jQuery);