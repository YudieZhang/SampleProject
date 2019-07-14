;
(function ($, window, document, undefined) {
    var Marking = function (ele, opt) {
        this.$element = ele,
            this.defaults = {
                'height': 20,
                'width': 20,
                'spaceBetween': 2,
                'backgroundImageInitial': 'images/star_hollow.png',
                'backgroundImageOver': 'images/star_solid.png',
                'num': 5,
                'havePoint': false,
                'haveGrade': false,
				'modify':false,
                'unit': '',
                'grade': 0,
            },
            this.options = $.extend({}, this.defaults, opt)
    }
    Marking.prototype = {
        setImages: function () {
            var htmlItem = '<div class="set_image_item"><img style="height:100%;" src="' + this.options.backgroundImageInitial + '" alt=""></div>';
            var htmlAll = '';
            for (var i = 0; i < this.options.num; i++) {
                htmlAll = htmlItem + htmlAll;
            };
            var html = '<div class="set_image_all">' + htmlAll + '</div>';
            return this.$element.append(html);
        },
        // Init
        begin: function () {
            var that = this.$element;
            var This = this;
            var grade = this.options.grade;
            if (This.options.haveGrade) {
                that.append('<span class="grade">' + grade + This.options.unit + '</span>');
                that.find('.grade').css({
                    'display': 'inline-block',
                    'height': This.options.height + 'px',
                    'line-height': This.options.height + 'px',
                })
            }
            console.log( This.options.height)
            that.find('.set_image_item').css({
                'height': This.options.height + 'px',
                'width': This.options.width + 'px',
            })
            var htmlTop = '';
            console.log(Math.ceil(grade))
            for (var i = 0; i <Math.ceil(grade); i++) {
                htmlTop = htmlTop + '<div><img style="height:100%;" src="' + This.options.backgroundImageOver + '" alt=""></div>';
            }
            that.find('.set_image_all').append('<div class="set_image_top">' + htmlTop + '</div>');
            that.find('.set_image_top>div').css({
                'height': This.options.height + 'px',
                'width': This.options.width + 'px',
            })
            if((This.options.havePoint)&&(grade%1!=0)){
                that.find('.set_image_top>div').last().css({
                    'width': This.options.width * (grade -  Math.floor(grade)) + 'px',
                })
            }
        },
        // Click
        clickChangeAll: function () {
            var that = this.$element;
            var This = this;
            var grade = this.options.grade;
			if (This.options.modify){
            that.find('.set_image_item').click(function(e) {
                grade = $(this).index() + 1
                // console.log(grade)
                that.find('.set_image_top').remove()
                var htmlTop = '';
                for (var i = 0; i <= $(this).index(); i++) {
                    htmlTop = htmlTop + '<div><img style="height:100%;" src="' + This.options.backgroundImageOver + '" alt=""></div>';
                }
                that.find('.set_image_all').append('<div class="set_image_top">' + htmlTop + '</div>');
                that.find('.set_image_top>div').css({
                    'height': This.options.height + 'px',
                    'width': This.options.width + 'px',
                    'margin-right': This.options.spaceBetween + 'px',
                })
                if (This.options.havePoint) {
                    var X1 = e.pageX - $(this).offset().left;
                    console.log(X1)
                    that.find('.set_image_top>div').last().css({
                        'width': X1 + 'px',
                    })
                    grade = grade + X1 / This.options.width - 1;
                    grade = grade.toFixed(1)
                    // console.log(grade)  
                }
                if (This.options.haveGrade) {
                    that.find('.grade').remove()
                    that.append('<span class="grade">' + grade + This.options.unit + '</span>');
                    that.find('.grade').css({
                        'display': 'inline-block',
                        'height': This.options.height + 'px',
                        'line-height': This.options.height + 'px',
                    })
                }
            })
			}
        },
        myCss: function () {
            $('.set_image_item').parent().css({
                'display': 'inline-block',
            })
            $('.set_image_item').css({
                'margin-right': this.options.spaceBetween + 'px',
            })
            $('.set_image_top>div').css({
                'margin-right': this.options.spaceBetween + 'px',
            })
        }
    }
    $.fn.markingSystem = function (options) {
        var marking = new Marking(this, options);
        marking.setImages();
        marking.begin();
        marking.clickChangeAll();
        return marking.myCss();
    }
})(jQuery, window, document);