$(document).ready(function(){

// -----Side-nav-btn
  sideNavBtnToggle()
  function sideNavBtnToggle() {
    var sideNavMenuBtn = 'nav #menu-bar-btn'
    var sideNav = '#side-nav'
    var sideNavOverlayDiv = '<div id="sidenav-overlay"></div>'
    var sideNavOverlay = '#sidenav-overlay'
    var sideNavOn = 'side-nav-on'
    var displaySideNav = {
      'transform': 'translateX(0)',
      'opacity': '1',
    }
    var hideSideNav = {
      'transform': 'translateX(-105%)',
      'opacity': '0',
    }
    $(document).on('click', sideNavMenuBtn, function () {
      $(sideNav).css(displaySideNav)
      $(sideNav).addClass(sideNavOn)
      $('body').append(sideNavOverlayDiv)
      $(sideNavOverlay).animate({
        opacity: 1
      }, 300)
    })
    $(document).on('click', sideNavOverlay, function () {
      $(sideNav).css(hideSideNav)
      $(sideNav).removeClass(sideNavOn)
      $(sideNavOverlay).remove()
    })
  }

// Parallax effect
  $(window).scroll(function() {
    var scrolled = $(window).scrollTop()
    var parallaxContainer = '.parallax-container > .image-wrapper > .div-cover'
    var parallaxObject = '.parallax-container > .hero.image-wrapper #parallax-object'
    $('.parallax-container').each(function(index, element) {
      // var initY = $(this).offset().top
      var initY = 0
      var height = $(this).height()
      var width = $(this).width()
      var endY  = initY + $(this).height()

      // Check if the element is in the viewport.
      if (width >= 600) {
        var visible = isInViewport(this)
        if(visible) {
          var diff = scrolled - initY
          var ratio = Math.round((diff / height) * 100)
            $(parallaxContainer).css('background-position', '50% calc(50% - ' + parseInt(ratio * 1.5) + 'px)')
            $(parallaxObject).css('top', parseInt(-ratio * 3) + 'px')
        }
      }
    })
  })

  function isInViewport(node) {
    var rect = node.getBoundingClientRect()
    return (
      (rect.height > 0 || rect.width > 0) &&
      rect.bottom >= 0 &&
      rect.right >= 0 &&
      rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.left <= (window.innerWidth || document.documentElement.clientWidth)
    )
  }

// -----Slider
  if ($('.slide-window')) {

    var slideNum = $('.slide').length - 1
    var maxSlideNum = $('.slide').length - 1
    var slideWidth = $('.slide-window').outerWidth()
    var slideSetWidth = slideWidth * slideNum
    var controlSlideBtnLeft = '.slide-control-left'
    var controlSlideBtnRight = '.slide-control-right'
    var controlSlideBtnList = '.slide-control-btn ul li a'
    // var addCssToSlide = {
    //   'width': (slideNum + 3) * 100 + '%',
    //   'left': -slideWidth
    // }
    // $('.slide-window .slide-wrapper').css(addCssToSlide)
    // var firstSlide = $('.slide-wrapper .slide:first-child')
    // var lastSlide = $('.slide-wrapper .slide:last-child')
    // firstSlide.before(lastSlide.clone(true))
    // lastSlide.after(firstSlide.clone(true))

    addSlideCtlBtn()

    var slideCurrent = 0
    var slideActiveBtn = 0
    var rotationInterval = setInterval(function(){
      slideCurrent++
      if (slideCurrent > maxSlideNum) {
        slideCurrent = 0
      }
      activation()
      sliding()
    }, 10000)

    $(controlSlideBtnLeft).on('click', function(){
      resetInterval()
      slideCurrent--
      if (slideCurrent < 0) {
        slideCurrent = maxSlideNum
      }
      activation()
      rotateArrow('left')
      sliding()
    })
    $(controlSlideBtnRight).on('click', function(){
      resetInterval()
      slideCurrent++
      if (slideCurrent > maxSlideNum) {
        slideCurrent = 0
      }
      activation()
      rotateArrow('right')
      sliding()
    })
    $(controlSlideBtnList).on('click', function(){
      resetInterval()
      slideCurrent = $(controlSlideBtnList).index(this)
      activation()
      sliding()
    })

    function addSlideCtlBtn() {
      var slideCtlBtn = '<div class="slide-control-btn"><ul>'
      for (var i = 0; i <= maxSlideNum; i++) {
        if (i==0) {
          slideCtlBtn += '<li><a class="active"></a></li>'
        }
        else {
          slideCtlBtn += '<li><a class=""></a></li>'
        }
      }
      slideCtlBtn += '</ul></div>'
      $('.slide-controller').append(slideCtlBtn)
    }
    function resetInterval() {
      clearInterval(rotationInterval)
      rotationInterval = setInterval(function(){
        slideCurrent++
        if (slideCurrent > maxSlideNum) {
          slideCurrent = 0
        }
        activation()
        sliding()
      }, 10000)
    }
    function activation() {
      slideActiveBtn = slideCurrent + 1
      $( controlSlideBtnList + '.active' ).removeClass()
      $('.slide-control-btn ul li:nth-child(' + slideActiveBtn + ') a').addClass('active')
    }
    function rotateArrow(direction) {
      var slideCtlLine1 = '.slide-control-' + direction + ' .slide-control-line:nth-child(1)'
      var slideCtlLine2 = '.slide-control-' + direction + ' .slide-control-line:nth-child(2)'
      $(slideCtlLine1).removeClass('rotate-' + direction + '-top')
      $(slideCtlLine2).removeClass('rotate-' + direction + '-down')
      $(slideCtlLine1).outerWidth()
      $(slideCtlLine2).outerWidth()
      $(slideCtlLine1).addClass('rotate-' + direction + '-top')
      $(slideCtlLine2).addClass('rotate-' + direction + '-down')
    }
    function sliding() {
      $('.slide-wrapper').css('left', slideCurrent * -slideWidth)
    }
  }

// -----Table of contents
  if ($('.single-page').length) {
    var firstH2 = $('#contents h2').first()
    var tableOfContents = '<div class="index-outline"><p><span>記事内目次</span></p><ol>'
    var level = 0
    var currentLevel = 0
    var h2Number = 0
    var h3Number = 0
    var h4Number = 0
    var headingNumber = 0

    $('article h2, article h3, article h4').each(function(i) {
      if ($(this).prop('tagName') == 'H2') {
        level = 0
      }
      else if ($(this).prop('tagName') == 'H3') {
        level = 1
      }
      else if ($(this).prop('tagName') == 'H4') {
        level = 2
      }

      if (currentLevel < level) {
        tableOfContents += '<li><ol>'
        currentLevel = level
      }
      else if (currentLevel > level) {
        tableOfContents += '</ol></li>'
        currentLevel = level
      }

      switch (level) {
        case 0:
          h2Number++
          headingNumber = h2Number
          h3Number = 0
          break
        case 1:
          h3Number++
          headingNumber = h2Number + '-' + h3Number
          h4Number = 0
          break
        case 2:
          h4Number++
          headingNumber = h2Number + '-' + h3Number + '-' + h4Number
          break
      }

      $(this).attr('id', 'index-toc-' + i)
      tableOfContents += '<li><a href="#index-toc-' + i + '">' + headingNumber + '. ' + $(this).text() + '</a></li>'
    })

    tableOfContents += '</ol></div>'
    $(firstH2[0]).before(tableOfContents)
    $('#sidebar #side').append('<aside></aside>')
    $('#sidebar #side aside').last().append(tableOfContents)
  }

// -----Scroll smoother

  var internalLink = 'a[href*=\\#]'
  var htmlBody = 'html, body'
  $(internalLink).click(function(event){
    event.preventDefault()
    if ($(this).attr('href')=='#top') {
      $(htmlBody).animate({scrollTop : 0},1000)
      return false
    }
    else {
      $(htmlBody).animate({
        scrollTop: $( $.attr(this, 'href') ).position().top + 60
      }, 1000);
    }
  })

  // Scroll to top
  var scrollToTopBtn = '#scroll-to-top'
  $(window).scroll(function() {
    if ($(this).scrollTop() >= 500) {
      $(scrollToTopBtn).addClass('fade-in')
    } else {
      $(scrollToTopBtn).removeClass('fade-in')
    }
  })

})// document ready end
