var $jscomp = $jscomp || {};
$jscomp.scope = {};
$jscomp.findInternal = function (e, b, a) {
  e instanceof String && (e = String(e));
  for (var d = e.length, c = 0; c < d; c++) {
    var l = e[c];
    if (b.call(a, l, c, e)) return { i: c, v: l };
  }
  return { i: -1, v: void 0 };
};
$jscomp.ASSUME_ES5 = !1;
$jscomp.ASSUME_NO_NATIVE_MAP = !1;
$jscomp.ASSUME_NO_NATIVE_SET = !1;
$jscomp.SIMPLE_FROUND_POLYFILL = !1;
$jscomp.defineProperty =
  $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties
    ? Object.defineProperty
    : function (e, b, a) {
        e != Array.prototype && e != Object.prototype && (e[b] = a.value);
      };
$jscomp.getGlobal = function (e) {
  return "undefined" != typeof window && window === e
    ? e
    : "undefined" != typeof global && null != global
    ? global
    : e;
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function (e, b, a, d) {
  if (b) {
    a = $jscomp.global;
    e = e.split(".");
    for (d = 0; d < e.length - 1; d++) {
      var c = e[d];
      c in a || (a[c] = {});
      a = a[c];
    }
    e = e[e.length - 1];
    d = a[e];
    b = b(d);
    b != d &&
      null != b &&
      $jscomp.defineProperty(a, e, {
        configurable: !0,
        writable: !0,
        value: b,
      });
  }
};
$jscomp.polyfill(
  "Array.prototype.find",
  function (e) {
    return e
      ? e
      : function (b, a) {
          return $jscomp.findInternal(this, b, a).v;
        };
  },
  "es6",
  "es3"
);
var get_vimeo_videoID = function (e) {
  return 0 < e.indexOf("vimeo.com")
    ? e.substr(e.lastIndexOf("/") + 1, e.length)
    : 15 < e.length
    ? null
    : e;
};
(function (e) {
  jQuery.vimeo_player = {
    name: "jquery.mb.vimeo_player",
    author: "Matteo Bicocchi (pupunzi)",
    version: "1.0.6",
    build: "373",
    defaults: {
      containment: "body",
      ratio: "16/9",
      videoURL: null,
      startAt: 0,
      stopAt: 0,
      autoPlay: !0,
      vol: 50,
      addRaster: !1,
      opacity: 1,
      mute: !1,
      loop: !0,
      showControls: !0,
      show_vimeo_logo: !0,
      stopMovieOnBlur: !0,
      realfullscreen: !0,
      mobileFallbackImage: null,
      gaTrack: !0,
      optimizeDisplay: !0,
      mask: !1,
      align: "center,center",
      onReady: function (b) {},
    },
    controls: {
      play: "P",
      pause: "p",
      mute: "M",
      unmute: "A",
      fullscreen: "O",
      showSite: "R",
      logo: "V",
    },
    buildPlayer: function (b) {
      var a = function () {
          var c = !1;
          try {
            self.location.href != top.location.href && (c = !0);
          } catch (l) {
            c = !0;
          }
          return c;
        },
        d = document.createElement("script");
      d.src = "https://player.vimeo.com/api/player.js";
      d.onload = function () {
        jQuery(document).trigger("vimeo_api_loaded");
      };
      document.head.appendChild(d);
      return this.each(function () {
        var c = this,
          d = jQuery(c);
        c.loop = 0;
        c.opt = {};
        c.state = {};
        c.id = c.id || "YTP_" + new Date().getTime();
        d.addClass("vimeo_player");
        var e =
          d.data("property") && "string" == typeof d.data("property")
            ? eval("(" + d.data("property") + ")")
            : d.data("property");
        jQuery.extend(c.opt, jQuery.vimeo_player.defaults, b, e);
        c.opt.ratio = "auto" == c.opt.ratio ? "16/9" : c.opt.ratio;
        eval(c.opt.loop) && (c.opt.loop = 9999);
        c.isRetina = window.retina || 1 < window.devicePixelRatio;
        c.canGoFullScreen = !(
          jQuery.browser.msie ||
          jQuery.browser.opera ||
          a()
        );
        c.canGoFullScreen || (c.opt.realfullscreen = !1);
        c.isAlone = !1;
        c.hasFocus = !0;
        c.videoID = this.opt.videoURL
          ? get_vimeo_videoID(this.opt.videoURL)
          : d.attr("href")
          ? get_vimeo_videoID(d.attr("href"))
          : !1;
        c.isSelf = "self" == c.opt.containment;
        c.opt.containment =
          "self" == c.opt.containment
            ? jQuery(this)
            : jQuery(c.opt.containment);
        c.isBackground = c.opt.containment.is("body");
        if (!c.isBackground || !c.backgroundIsInited) {
          c.canPlayOnMobile = c.isSelf && 0 === jQuery(this).children().length;
          c.isSelf || d.hide();
          e = jQuery("<div/>")
            .css({
              position: "absolute",
              top: 0,
              left: 0,
              width: "100%",
              height: "100%",
            })
            .addClass("vimeo_player_overlay");
          var g = "vimeo_player_" + c.id,
            f = jQuery("<div/>")
              .addClass("vimeo_player_wrapper")
              .attr("id", "vimeo_player_wrapper_" + g);
          f.css({
            position: "absolute",
            zIndex: 0,
            minWidth: "100%",
            minHeight: "100%",
            left: 0,
            top: 0,
            overflow: "hidden",
            opacity: 0,
          });
          c.playerBox = jQuery("<iframe/>").attr("id", g).addClass("playerBox");
          c.playerBox
            .css({
              position: "absolute",
              zIndex: 0,
              width: "100%",
              height: "100%",
              top: -10,
              frameBorder: 0,
              overflow: "hidden",
              left: 0,
            })
            .attr({
              src:
                "https://player.vimeo.com/video/" +
                c.videoID +
                "?background=1&autopause=0",
            });
          if (!jQuery.browser.mobile || c.canPlayOnMobile) {
            f.append(c.playerBox);
            c.opt.containment
              .children()
              .not("script, style")
              .each(function () {
                "static" == jQuery(this).css("position") &&
                  jQuery(this).css("position", "relative");
              });
            c.isBackground
              ? (jQuery("body").css({ boxSizing: "border-box" }),
                f.css({ position: "fixed", top: 0, left: 0, zIndex: 0 }))
              : "static" == c.opt.containment.css("position") &&
                c.opt.containment.css({ position: "relative" });
            c.opt.containment.prepend(f);
            c.wrapper = f;
            c.playerBox.css({ opacity: 1 });
            jQuery.browser.mobile || (c.playerBox.after(e), (c.overlay = e));
            if (!c.isBackground)
              e.on("mouseenter", function () {
                c.controlBar &&
                  c.controlBar.length &&
                  c.controlBar.addClass("visible");
              }).on("mouseleave", function () {
                c.controlBar &&
                  c.controlBar.length &&
                  c.controlBar.removeClass("visible");
              });
            jQuery(document).on("vimeo_api_loaded", function () {
              c.player = new Vimeo.Player(g, b);
              c.player.ready().then(function () {
                function a() {
                  c.isReady = !0;
                  c.opt.mute &&
                    setTimeout(function () {
                      d.v_mute();
                    }, 1e3);
                  c.opt.showControls && jQuery.vimeo_player.buildControls(c);
                  c.opt.autoPlay
                    ? setTimeout(function () {
                        d.v_play();
                        setTimeout(function () {
                          b = jQuery.Event("VPStart");
                          d.trigger(b);
                        }, 1500);
                      }, 100)
                    : d.v_pause();
                  b = jQuery.Event("VPReady");
                  d.trigger(b);
                }
                var b;
                c.opt.startAt
                  ? (c.player.play().then(function () {
                      c.player.pause();
                    }),
                    d.v_seekTo(c.opt.startAt, function () {
                      a();
                    }))
                  : a();
                d.v_optimize_display();
                jQuery(window)
                  .off("resize.vimeo_player_" + c.id)
                  .on("resize.vimeo_player_" + c.id, function () {
                    d.v_optimize_display();
                  });
                c.player.on("progress", function (b) {
                  console.debug("progress:: ", b);
                });
                c.player.on("error", function (a) {
                  c.state = -1;
                  b = jQuery.Event("VPError");
                  b.error = a;
                  d.trigger(b);
                });
                c.player.on("play", function (a) {
                  c.state = 1;
                  d.trigger("change_state");
                  c.controlBar &&
                    c.controlBar.length &&
                    c.controlBar
                      .find(".vimeo_player_pause")
                      .html(jQuery.vimeo_player.controls.pause);
                  "undefined" != typeof _gaq &&
                    eval(c.opt.gaTrack) &&
                    _gaq.push([
                      "_trackEvent",
                      "vimeo_player",
                      "Play",
                      c.videoID,
                    ]);
                  "undefined" != typeof ga &&
                    eval(c.opt.gaTrack) &&
                    ga("send", "event", "vimeo_player", "play", c.videoID);
                  b = jQuery.Event("VPPlay");
                  b.error = a;
                  d.trigger(b);
                });
                c.player.on("pause", function (a) {
                  c.state = 2;
                  d.trigger("change_state");
                  c.controlBar &&
                    c.controlBar.length &&
                    c.controlBar
                      .find(".vimeo_player_pause")
                      .html(jQuery.vimeo_player.controls.play);
                  b = jQuery.Event("VPPause");
                  b.time = a;
                  d.trigger(b);
                });
                c.player.on("seeked", function (b) {
                  c.state = 3;
                  d.trigger("change_state");
                });
                c.player.on("ended", function (a) {
                  c.state = 0;
                  d.trigger("change_state");
                  b = jQuery.Event("VPEnd");
                  b.time = a;
                  d.trigger(b);
                });
                c.player.on("timeupdate", function (a) {
                  c.duration = a.duration;
                  c.percent = a.percent;
                  c.seconds = a.seconds;
                  c.state = 1;
                  c.player.getPaused().then(function (a) {
                    a && (c.state = 2);
                  });
                  c.opt.stopMovieOnBlur &&
                    !document.hasFocus() &&
                    1 == c.state &&
                    ((c.hasFocus = !1),
                    d.v_pause(),
                    (c.document_focus = setInterval(function () {
                      document.hasFocus() &&
                        !c.hasFocus &&
                        ((c.hasFocus = !0),
                        d.v_play(),
                        clearInterval(c.document_focus));
                    }, 300)));
                  if (c.opt.showControls) {
                    var e = jQuery("#controlBar_" + c.id),
                      l = e.find(".vimeo_player_pogress"),
                      f = e.find(".vimeo_player_loaded");
                    e = e.find(".vimeo_player_seek_bar");
                    l = l.outerWidth();
                    l = (Math.floor(a.seconds) * l) / Math.floor(a.duration);
                    f.css({ left: 0, width: 100 * a.percent + "%" });
                    e.css({ left: 0, width: l });
                    a.duration
                      ? c.controlBar
                          .find(".vimeo_player_time")
                          .html(
                            jQuery.vimeo_player.formatTime(a.seconds) +
                              " / " +
                              jQuery.vimeo_player.formatTime(a.duration)
                          )
                      : c.controlBar
                          .find(".vimeo_player_time")
                          .html("-- : -- / -- : --");
                  }
                  c.opt.addRaster
                    ? ((f = "dot" == c.opt.addRaster ? "raster-dot" : "raster"),
                      c.overlay.addClass(c.isRetina ? f + " retina" : f))
                    : c.overlay.removeClass(function (a, b) {
                        a = b.split(" ");
                        var c = [];
                        jQuery.each(a, function (a, b) {
                          /raster.*/.test(b) && c.push(b);
                        });
                        c.push("retina");
                        return c.join(" ");
                      });
                  c.opt.stopAt =
                    c.opt.stopAt > a.duration ? a.duration - 0.6 : c.opt.stopAt;
                  a.seconds >= (c.opt.stopAt || a.duration - 0.6) &&
                    ((c.loop = c.loop || 0),
                    c.opt.loop && c.loop < c.opt.loop
                      ? (d.v_seekTo(c.opt.startAt), c.loop++)
                      : (d.v_pause(),
                        (c.state = 0),
                        d.trigger("change_state")));
                  b = jQuery.Event("VPTime");
                  b.time = a.seconds;
                  d.trigger(b);
                });
              });
              d.on("change_state", function () {
                console.debug("player state:: ", c.state);
                0 == c.state &&
                  c.wrapper.fadeOut(500, function () {
                    d.v_seekTo(0);
                  });
              });
            });
          } else
            c.opt.mobileFallbackImage &&
              f.css({
                backgroundImage: "url(" + c.opt.mobileFallbackImage + ")",
                backgroundPosition: "center center",
                backgroundSize: "cover",
                backgroundRepeat: "no-repeat",
                opacity: 1,
              }),
              d.remove();
        }
      });
    },
    formatTime: function (b) {
      var a = Math.floor(b / 60);
      b = Math.floor(b - 60 * a);
      return (9 >= a ? "0" + a : a) + " : " + (9 >= b ? "0" + b : b);
    },
    play: function () {
      var b = this.get(0);
      if (!b.isReady) return this;
      b.player.play();
      setTimeout(function () {
        b.wrapper.fadeTo(1e3, b.opt.opacity);
      }, 1e3);
      var a = jQuery("#controlBar_" + b.id);
      a.length &&
        a
          .find(".mb_YTPPvimeo_player_playpause")
          .html(jQuery.vimeo_player.controls.pause);
      b.state = 1;
      jQuery(b).css("background-image", "none");
      return this;
    },
    togglePlay: function (b) {
      var a = this.get(0);
      1 == a.state ? this.v_pause() : this.v_play();
      "function" == typeof b && b(a.state);
      return this;
    },
    pause: function () {
      var b = this.get(0);
      b.player.pause();
      b.state = 2;
      return this;
    },
    seekTo: function (b, a) {
      var d = this.get(0);
      d.player
        .setCurrentTime(
          d.opt.stopAt && b >= d.opt.stopAt ? d.opt.stopAt - 0.5 : b
        )
        .then(function (b) {
          "function" == typeof a && a(b);
        });
      return this;
    },
    setVolume: function (b) {
      var a = this.get(0);
      console.debug("setVolume:: ", b);
      console.debug("volume:: ", a.opt.vol);
      b || a.opt.vol || !a.isMute
        ? (!b && !a.isMute) || (b && a.opt.vol == b)
          ? a.isMute
            ? jQuery(a).v_mute()
            : jQuery(a).v_unmute()
          : ((a.opt.vol = b),
            a.player.setVolume(a.opt.vol),
            a.volumeBar &&
              a.volumeBar.length &&
              a.volumeBar.updateSliderVal(100 * b))
        : jQuery(a).v_unmute();
      return this;
    },
    toggleVolume: function () {
      var b = this.get(0);
      if (b) {
        if (b.isMute) return jQuery(b).v_unmute(), !0;
        jQuery(b).v_mute();
        return !1;
      }
    },
    mute: function () {
      var b = this.get(0);
      if (!b.isMute)
        return (
          (b.isMute = !0),
          b.player.setVolume(0),
          b.volumeBar &&
            b.volumeBar.length &&
            10 < b.volumeBar.width() &&
            b.volumeBar.updateSliderVal(0),
          jQuery("#controlBar_" + b.id)
            .find(".vimeo_player_muteUnmute")
            .html(jQuery.vimeo_player.controls.unmute),
          jQuery(b).addClass("isMuted"),
          b.volumeBar && b.volumeBar.length && b.volumeBar.addClass("muted"),
          this
        );
    },
    unmute: function () {
      var b = this.get(0);
      if (b.isMute)
        return (
          (b.isMute = !1),
          jQuery(b).v_set_volume(b.opt.vol),
          b.volumeBar &&
            b.volumeBar.length &&
            b.volumeBar.updateSliderVal(0.1 < b.opt.vol ? b.opt.vol : 0.1),
          jQuery("#controlBar_" + b.id)
            .find(".vimeo_player_muteUnmute")
            .html(jQuery.vimeo_player.controls.mute),
          jQuery(b).removeClass("isMuted"),
          b.volumeBar && b.volumeBar.length && b.volumeBar.removeClass("muted"),
          this
        );
    },
    changeMovie: function (b) {
      var a = this.get(0);
      a.player.loadVideo(b.url).then(function (b) {
        jQuery(a).v_setState();
      });
    },
    buildControls: function (b) {
      var a = b.opt;
      if (!jQuery("#controlBar_" + b.id).length) {
        b.controlBar = jQuery("<span/>")
          .attr("id", "controlBar_" + b.id)
          .addClass("vimeo_player_bar")
          .css({
            whiteSpace: "noWrap",
            position: b.isBackground ? "fixed" : "absolute",
            zIndex: b.isBackground ? 1e4 : 1e3,
          });
        var d = jQuery("<div/>").addClass("buttonBar"),
          c = jQuery("<span>" + jQuery.vimeo_player.controls.play + "</span>")
            .addClass("vimeo_player_pause vimeo_icon")
            .click(function () {
              1 == b.state ? jQuery(b).v_pause() : jQuery(b).v_play();
            }),
          e = jQuery("<span>" + jQuery.vimeo_player.controls.mute + "</span>")
            .addClass("vimeo_player_muteUnmute vimeo_icon")
            .click(function () {
              b.isMute ? jQuery(b).v_unmute() : jQuery(b).v_mute();
            }),
          h = jQuery("<div/>")
            .addClass("vimeo_player_volume_bar")
            .css({ display: "inline-block" });
        b.volumeBar = h;
        var g = jQuery("<span/>").addClass("vimeo_player_time"),
          f = "https://vimeo.com/" + b.videoID,
          k = jQuery("<span/>")
            .html(jQuery.vimeo_player.controls.logo)
            .addClass("vimeo_url vimeo_icon")
            .attr("title", "view on Vimeo")
            .on("click", function () {
              console.debug(f);
              window.open(f, "viewOnVimeo");
            }),
          m = jQuery("<span/>")
            .html(jQuery.vimeo_player.controls.fullscreen)
            .addClass("vimeo_fullscreen vimeo_icon")
            .on("click", function () {
              jQuery(b).v_fullscreen(a.realfullscreen);
            }),
          n = jQuery("<div/>")
            .addClass("vimeo_player_pogress")
            .css("position", "absolute")
            .click(function (a) {
              p.css({ width: a.clientX - p.offset().left });
              b.timeW = a.clientX - p.offset().left;
              b.controlBar.find(".vimeo_player_loaded").css({ width: 0 });
              a = Math.floor(b.duration);
              b.goto = (p.outerWidth() * a) / n.outerWidth();
              console.debug(b.goto);
              jQuery(b).v_seekTo(parseFloat(b.goto));
              b.controlBar.find(".vimeo_player_loaded").css({ width: 0 });
            }),
          q = jQuery("<div/>")
            .addClass("vimeo_player_loaded")
            .css("position", "absolute"),
          p = jQuery("<div/>")
            .addClass("vimeo_player_seek_bar")
            .css("position", "absolute");
        n.append(q).append(p);
        d.append(c).append(e).append(h).append(g);
        a.show_vimeo_logo && d.append(k);
        (b.isBackground || (eval(b.opt.realfullscreen) && !b.isBackground)) &&
          d.append(m);
        b.controlBar.append(d).append(n);
        b.isBackground
          ? jQuery("body").after(b.controlBar)
          : b.wrapper.before(b.controlBar);
        h.simpleSlider({
          initialval: b.opt.vol,
          scale: 100,
          orientation: "h",
          callback: function (a) {
            0 == a.value ? jQuery(b).v_mute() : jQuery(b).v_unmute();
            b.player.setVolume(a.value / 100);
            b.isMute || (b.opt.vol = a.value);
          },
        });
      }
    },
    optimizeVimeoDisplay: function (b) {
      var a = this.get(0);
      a.opt.align = b || a.opt.align;
      a.opt.align =
        "undefined " != typeof a.opt.align ? a.opt.align : "center,center";
      b = a.opt.align.split(",");
      if (a.opt.optimizeDisplay) {
        var d = a.isPlayer ? 0 : 80;
        var c = a.wrapper;
        var e = c.outerWidth();
        var h = c.outerHeight() + d;
        c = e;
        var g =
          "16/9" == a.opt.ratio ? Math.ceil(0.5625 * c) : Math.ceil(0.75 * c);
        var f = -((g - h) / 2);
        var k = 0;
        var m = g < h;
        m &&
          ((g = h + d),
          (c =
            "16/9" == a.opt.ratio
              ? Math.floor((16 / 9) * g)
              : Math.floor((4 / 3) * g)),
          (f = 0),
          (k = -((c - e) / 2)));
        for (var n in b)
          if (b.hasOwnProperty(n))
            switch (b[n].replace(/ /g, "")) {
              case "top":
                f = m ? -((g - h) / 2) : 0;
                break;
              case "bottom":
                f = m ? 0 : -(g - h);
                break;
              case "left":
                k = 0;
                break;
              case "right":
                k = m ? -(c - e) : 0;
                break;
              default:
                c > e && (k = -((c - e) / 2));
            }
      } else (g = c = "100%"), (k = f = 0);
      a.playerBox.css({
        width: c,
        height: g,
        marginTop: f,
        marginLeft: k,
        maxWidth: "initial",
      });
    },
    setAlign: function (b) {
      this.v_optimize_display(b);
    },
    getAlign: function () {
      return this.get(0).opt.align;
    },
    fullscreen: function (b) {
      function a(a, b) {
        for (
          var c = ["webkit", "moz", "ms", "o", ""], d = 0, e, f;
          d < c.length && !a[e];

        ) {
          e = b;
          "" == c[d] && (e = e.substr(0, 1).toLowerCase() + e.substr(1));
          e = c[d] + e;
          f = typeof a[e];
          if ("undefined" != f) return "function" == f ? a[e]() : a[e];
          d++;
        }
      }
      var d = this.get(0),
        c = jQuery(d),
        e;
      "undefined" == typeof b && (b = d.opt.realfullscreen);
      b = eval(b);
      var h = jQuery("#controlBar_" + d.id),
        g = h.find(".vimeo_fullscreen"),
        f = d.isSelf ? d.opt.containment : d.wrapper;
      if (b) {
        var k = jQuery.browser.mozilla
          ? "mozfullscreenchange"
          : jQuery.browser.webkit
          ? "webkitfullscreenchange"
          : "fullscreenchange";
        jQuery(document)
          .off(k)
          .on(k, function () {
            a(document, "IsFullScreen") || a(document, "FullScreen")
              ? (e = jQuery.Event("VPFullScreenStart"))
              : ((d.isAlone = !1),
                g.html(jQuery.vimeo_player.controls.fullscreen),
                f.removeClass("vimeo_player_Fullscreen"),
                f.fadeTo(500, d.opt.opacity),
                f.css({ zIndex: 0 }),
                d.isBackground ? jQuery("body").after(h) : d.wrapper.before(h),
                jQuery(window).resize(),
                (e = jQuery.Event("VPFullScreenEnd")));
            c.trigger(e);
          });
      }
      if (d.isAlone)
        jQuery(document).off("mousemove.vimeo_player"),
          clearTimeout(d.hideCursor),
          d.overlay.css({ cursor: "auto" }),
          b
            ? (a(document, "FullScreen") || a(document, "IsFullScreen")) &&
              a(document, "CancelFullScreen")
            : f.fadeTo(1e3, d.opt.opacity).css({ zIndex: 0 }),
          g.html(jQuery.vimeo_player.controls.fullscreen),
          (d.isAlone = !1);
      else {
        var m = function () {
          d.overlay.css({ cursor: "none" });
        };
        jQuery(document).on("mousemove.vimeo_player", function (a) {
          d.overlay.css({ cursor: "auto" });
          clearTimeout(d.hideCursor);
          jQuery(a.target).parents().is(".vimeo_player_bar") ||
            (d.hideCursor = setTimeout(m, 3e3));
        });
        m();
        b
          ? (f.css({ opacity: 0 }),
            f.addClass("vimeo_player_Fullscreen"),
            a(f.get(0), "RequestFullScreen"),
            setTimeout(function () {
              f.fadeTo(1e3, 1);
              d.wrapper.append(h);
              jQuery(d).v_optimize_display();
            }, 500))
          : f.css({ zIndex: 1e4 }).fadeTo(1e3, 1);
        g.html(jQuery.vimeo_player.controls.showSite);
        d.isAlone = !0;
      }
      return this;
    },
  };
  jQuery.fn.vimeo_player = jQuery.vimeo_player.buildPlayer;
  jQuery.fn.v_play = jQuery.vimeo_player.play;
  jQuery.fn.v_toggle_play = jQuery.vimeo_player.togglePlay;
  jQuery.fn.v_change_movie = jQuery.vimeo_player.changeMovie;
  jQuery.fn.v_pause = jQuery.vimeo_player.pause;
  jQuery.fn.v_seekTo = jQuery.vimeo_player.seekTo;
  jQuery.fn.v_optimize_display = jQuery.vimeo_player.optimizeVimeoDisplay;
  jQuery.fn.v_set_align = jQuery.vimeo_player.setAlign;
  jQuery.fn.v_get_align = jQuery.vimeo_player.getAlign;
  jQuery.fn.v_fullscreen = jQuery.vimeo_player.fullscreen;
  jQuery.fn.v_mute = jQuery.vimeo_player.mute;
  jQuery.fn.v_unmute = jQuery.vimeo_player.unmute;
  jQuery.fn.v_set_volume = jQuery.vimeo_player.setVolume;
  jQuery.fn.v_toggle_volume = jQuery.vimeo_player.toggleVolume;
})(jQuery);
var nAgt = navigator.userAgent;
if (!jQuery.browser) {
  var isTouchSupported = function () {
    var e = nAgt.msMaxTouchPoints,
      b = "ontouchstart" in document.createElement("div");
    return e || b ? !0 : !1;
  };
  jQuery.browser = {};
  jQuery.browser.mozilla = !1;
  jQuery.browser.webkit = !1;
  jQuery.browser.opera = !1;
  jQuery.browser.safari = !1;
  jQuery.browser.chrome = !1;
  jQuery.browser.androidStock = !1;
  jQuery.browser.msie = !1;
  jQuery.browser.edge = !1;
  jQuery.browser.hasTouch = isTouchSupported();
  jQuery.browser.ua = nAgt;
  jQuery.browser.name = navigator.appName;
  jQuery.browser.fullVersion = "" + parseFloat(navigator.appVersion);
  jQuery.browser.majorVersion = parseInt(navigator.appVersion, 10);
  var nameOffset, verOffset, ix;
  if (-1 != (verOffset = nAgt.indexOf("Opera")))
    (jQuery.browser.opera = !0),
      (jQuery.browser.name = "Opera"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 6)),
      -1 != (verOffset = nAgt.indexOf("Version")) &&
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8));
  else if (-1 != (verOffset = nAgt.indexOf("OPR")))
    (jQuery.browser.opera = !0),
      (jQuery.browser.name = "Opera"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 4));
  else if (-1 != (verOffset = nAgt.indexOf("MSIE")))
    (jQuery.browser.msie = !0),
      (jQuery.browser.name = "Microsoft Internet Explorer"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 5));
  else if (-1 != nAgt.indexOf("Trident")) {
    jQuery.browser.msie = !0;
    jQuery.browser.name = "Microsoft Internet Explorer";
    var start = nAgt.indexOf("rv:") + 3,
      end = start + 4;
    jQuery.browser.fullVersion = nAgt.substring(start, end);
  } else
    -1 != (verOffset = nAgt.indexOf("Edge"))
      ? ((jQuery.browser.edge = !0),
        (jQuery.browser.name = "Microsoft Edge"),
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 5)))
      : -1 != (verOffset = nAgt.indexOf("Chrome"))
      ? ((jQuery.browser.webkit = !0),
        (jQuery.browser.chrome = !0),
        (jQuery.browser.name = "Chrome"),
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)))
      : -1 < nAgt.indexOf("mozilla/5.0") &&
        -1 < nAgt.indexOf("android ") &&
        -1 < nAgt.indexOf("applewebkit") &&
        !(-1 < nAgt.indexOf("chrome"))
      ? ((verOffset = nAgt.indexOf("Chrome")),
        (jQuery.browser.webkit = !0),
        (jQuery.browser.androidStock = !0),
        (jQuery.browser.name = "androidStock"),
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)))
      : -1 != (verOffset = nAgt.indexOf("Safari"))
      ? ((jQuery.browser.webkit = !0),
        (jQuery.browser.safari = !0),
        (jQuery.browser.name = "Safari"),
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)),
        -1 != (verOffset = nAgt.indexOf("Version")) &&
          (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)))
      : -1 != (verOffset = nAgt.indexOf("AppleWebkit"))
      ? ((jQuery.browser.webkit = !0),
        (jQuery.browser.safari = !0),
        (jQuery.browser.name = "Safari"),
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)),
        -1 != (verOffset = nAgt.indexOf("Version")) &&
          (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)))
      : -1 != (verOffset = nAgt.indexOf("Firefox"))
      ? ((jQuery.browser.mozilla = !0),
        (jQuery.browser.name = "Firefox"),
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)))
      : (nameOffset = nAgt.lastIndexOf(" ") + 1) <
          (verOffset = nAgt.lastIndexOf("/")) &&
        ((jQuery.browser.name = nAgt.substring(nameOffset, verOffset)),
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 1)),
        jQuery.browser.name.toLowerCase() ==
          jQuery.browser.name.toUpperCase() &&
          (jQuery.browser.name = navigator.appName));
  -1 != (ix = jQuery.browser.fullVersion.indexOf(";")) &&
    (jQuery.browser.fullVersion = jQuery.browser.fullVersion.substring(0, ix));
  -1 != (ix = jQuery.browser.fullVersion.indexOf(" ")) &&
    (jQuery.browser.fullVersion = jQuery.browser.fullVersion.substring(0, ix));
  jQuery.browser.majorVersion = parseInt("" + jQuery.browser.fullVersion, 10);
  isNaN(jQuery.browser.majorVersion) &&
    ((jQuery.browser.fullVersion = "" + parseFloat(navigator.appVersion)),
    (jQuery.browser.majorVersion = parseInt(navigator.appVersion, 10)));
  jQuery.browser.version = jQuery.browser.majorVersion;
}
jQuery.browser.android = /Android/i.test(nAgt);
jQuery.browser.blackberry = /BlackBerry|BB|PlayBook/i.test(nAgt);
jQuery.browser.ios = /iPhone|iPad|iPod|webOS/i.test(nAgt);
jQuery.browser.operaMobile = /Opera Mini/i.test(nAgt);
jQuery.browser.windowsMobile = /IEMobile|Windows Phone/i.test(nAgt);
jQuery.browser.kindle = /Kindle|Silk/i.test(nAgt);
jQuery.browser.mobile =
  jQuery.browser.android ||
  jQuery.browser.blackberry ||
  jQuery.browser.ios ||
  jQuery.browser.windowsMobile ||
  jQuery.browser.operaMobile ||
  jQuery.browser.kindle;
jQuery.isMobile = jQuery.browser.mobile;
jQuery.isTablet = jQuery.browser.mobile && 765 < jQuery(window).width();
jQuery.isAndroidDefault = jQuery.browser.android && !/chrome/i.test(nAgt);
nAgt = navigator.userAgent;
jQuery.browser ||
  ((jQuery.browser = {}),
  (jQuery.browser.mozilla = !1),
  (jQuery.browser.webkit = !1),
  (jQuery.browser.opera = !1),
  (jQuery.browser.safari = !1),
  (jQuery.browser.chrome = !1),
  (jQuery.browser.androidStock = !1),
  (jQuery.browser.msie = !1),
  (jQuery.browser.ua = nAgt),
  (jQuery.browser.name = navigator.appName),
  (jQuery.browser.fullVersion = "" + parseFloat(navigator.appVersion)),
  (jQuery.browser.majorVersion = parseInt(navigator.appVersion, 10)),
  -1 != (verOffset = nAgt.indexOf("Opera"))
    ? ((jQuery.browser.opera = !0),
      (jQuery.browser.name = "Opera"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 6)),
      -1 != (verOffset = nAgt.indexOf("Version")) &&
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)))
    : -1 != (verOffset = nAgt.indexOf("OPR"))
    ? ((jQuery.browser.opera = !0),
      (jQuery.browser.name = "Opera"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 4)))
    : -1 != (verOffset = nAgt.indexOf("MSIE"))
    ? ((jQuery.browser.msie = !0),
      (jQuery.browser.name = "Microsoft Internet Explorer"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 5)))
    : -1 != nAgt.indexOf("Trident") || -1 != nAgt.indexOf("Edge")
    ? ((jQuery.browser.msie = !0),
      (jQuery.browser.name = "Microsoft Internet Explorer"),
      (start = nAgt.indexOf("rv:") + 3),
      (end = start + 4),
      (jQuery.browser.fullVersion = nAgt.substring(start, end)))
    : -1 != (verOffset = nAgt.indexOf("Chrome"))
    ? ((jQuery.browser.webkit = !0),
      (jQuery.browser.chrome = !0),
      (jQuery.browser.name = "Chrome"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)))
    : -1 < nAgt.indexOf("mozilla/5.0") &&
      -1 < nAgt.indexOf("android ") &&
      -1 < nAgt.indexOf("applewebkit") &&
      !(-1 < nAgt.indexOf("chrome"))
    ? ((verOffset = nAgt.indexOf("Chrome")),
      (jQuery.browser.webkit = !0),
      (jQuery.browser.androidStock = !0),
      (jQuery.browser.name = "androidStock"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)))
    : -1 != (verOffset = nAgt.indexOf("Safari"))
    ? ((jQuery.browser.webkit = !0),
      (jQuery.browser.safari = !0),
      (jQuery.browser.name = "Safari"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)),
      -1 != (verOffset = nAgt.indexOf("Version")) &&
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)))
    : -1 != (verOffset = nAgt.indexOf("AppleWebkit"))
    ? ((jQuery.browser.webkit = !0),
      (jQuery.browser.safari = !0),
      (jQuery.browser.name = "Safari"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)),
      -1 != (verOffset = nAgt.indexOf("Version")) &&
        (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)))
    : -1 != (verOffset = nAgt.indexOf("Firefox"))
    ? ((jQuery.browser.mozilla = !0),
      (jQuery.browser.name = "Firefox"),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)))
    : (nameOffset = nAgt.lastIndexOf(" ") + 1) <
        (verOffset = nAgt.lastIndexOf("/")) &&
      ((jQuery.browser.name = nAgt.substring(nameOffset, verOffset)),
      (jQuery.browser.fullVersion = nAgt.substring(verOffset + 1)),
      jQuery.browser.name.toLowerCase() == jQuery.browser.name.toUpperCase() &&
        (jQuery.browser.name = navigator.appName)),
  -1 != (ix = jQuery.browser.fullVersion.indexOf(";")) &&
    (jQuery.browser.fullVersion = jQuery.browser.fullVersion.substring(0, ix)),
  -1 != (ix = jQuery.browser.fullVersion.indexOf(" ")) &&
    (jQuery.browser.fullVersion = jQuery.browser.fullVersion.substring(0, ix)),
  (jQuery.browser.majorVersion = parseInt("" + jQuery.browser.fullVersion, 10)),
  isNaN(jQuery.browser.majorVersion) &&
    ((jQuery.browser.fullVersion = "" + parseFloat(navigator.appVersion)),
    (jQuery.browser.majorVersion = parseInt(navigator.appVersion, 10))),
  (jQuery.browser.version = jQuery.browser.majorVersion));
jQuery.browser.android = /Android/i.test(nAgt);
jQuery.browser.blackberry = /BlackBerry|BB|PlayBook/i.test(nAgt);
jQuery.browser.ios = /iPhone|iPad|iPod|webOS/i.test(nAgt);
jQuery.browser.operaMobile = /Opera Mini/i.test(nAgt);
jQuery.browser.windowsMobile = /IEMobile|Windows Phone/i.test(nAgt);
jQuery.browser.kindle = /Kindle|Silk/i.test(nAgt);
jQuery.browser.mobile =
  jQuery.browser.android ||
  jQuery.browser.blackberry ||
  jQuery.browser.ios ||
  jQuery.browser.windowsMobile ||
  jQuery.browser.operaMobile ||
  jQuery.browser.kindle;
jQuery.isMobile = jQuery.browser.mobile;
jQuery.isTablet = jQuery.browser.mobile && 765 < jQuery(window).width();
jQuery.isAndroidDefault = jQuery.browser.android && !/chrome/i.test(nAgt);
(function (e) {
  e.simpleSlider = {
    defaults: {
      initialval: 0,
      scale: 100,
      orientation: "h",
      readonly: !1,
      callback: !1,
    },
    events: {
      start: e.browser.mobile ? "touchstart" : "mousedown",
      end: e.browser.mobile ? "touchend" : "mouseup",
      move: e.browser.mobile ? "touchmove" : "mousemove",
    },
    init: function (b) {
      return this.each(function () {
        var a = this,
          d = e(a);
        d.addClass("simpleSlider");
        a.opt = {};
        e.extend(a.opt, e.simpleSlider.defaults, b);
        e.extend(a.opt, d.data());
        var c = "h" == a.opt.orientation ? "horizontal" : "vertical";
        c = e("<div/>").addClass("level").addClass(c);
        d.prepend(c);
        a.level = c;
        d.css({ cursor: "default" });
        "auto" == a.opt.scale && (a.opt.scale = e(a).outerWidth());
        d.updateSliderVal();
        a.opt.readonly ||
          (d.on(e.simpleSlider.events.start, function (b) {
            e.browser.mobile && (b = b.changedTouches[0]);
            a.canSlide = !0;
            d.updateSliderVal(b);
            "h" == a.opt.orientation
              ? d.css({ cursor: "col-resize" })
              : d.css({ cursor: "row-resize" });
            b.preventDefault();
            b.stopPropagation();
          }),
          e(document)
            .on(e.simpleSlider.events.move, function (b) {
              e.browser.mobile && (b = b.changedTouches[0]);
              a.canSlide &&
                (e(document).css({ cursor: "default" }),
                d.updateSliderVal(b),
                b.preventDefault(),
                b.stopPropagation());
            })
            .on(e.simpleSlider.events.end, function () {
              e(document).css({ cursor: "auto" });
              a.canSlide = !1;
              d.css({ cursor: "auto" });
            }));
      });
    },
    updateSliderVal: function (b) {
      var a = this.get(0);
      if (a.opt) {
        a.opt.initialval =
          "number" == typeof a.opt.initialval
            ? a.opt.initialval
            : a.opt.initialval(a);
        var d = e(a).outerWidth(),
          c = e(a).outerHeight();
        a.x =
          "object" == typeof b
            ? b.clientX + document.body.scrollLeft - this.offset().left
            : "number" == typeof b
            ? (b * d) / a.opt.scale
            : (a.opt.initialval * d) / a.opt.scale;
        a.y =
          "object" == typeof b
            ? b.clientY + document.body.scrollTop - this.offset().top
            : "number" == typeof b
            ? ((a.opt.scale - a.opt.initialval - b) * c) / a.opt.scale
            : (a.opt.initialval * c) / a.opt.scale;
        a.y = this.outerHeight() - a.y;
        a.scaleX = (a.x * a.opt.scale) / d;
        a.scaleY = (a.y * a.opt.scale) / c;
        a.outOfRangeX =
          a.scaleX > a.opt.scale
            ? a.scaleX - a.opt.scale
            : 0 > a.scaleX
            ? a.scaleX
            : 0;
        a.outOfRangeY =
          a.scaleY > a.opt.scale
            ? a.scaleY - a.opt.scale
            : 0 > a.scaleY
            ? a.scaleY
            : 0;
        a.outOfRange = "h" == a.opt.orientation ? a.outOfRangeX : a.outOfRangeY;
        a.value =
          "undefined" != typeof b
            ? "h" == a.opt.orientation
              ? a.x >= this.outerWidth()
                ? a.opt.scale
                : 0 >= a.x
                ? 0
                : a.scaleX
              : a.y >= this.outerHeight()
              ? a.opt.scale
              : 0 >= a.y
              ? 0
              : a.scaleY
            : "h" == a.opt.orientation
            ? a.scaleX
            : a.scaleY;
        "h" == a.opt.orientation
          ? a.level.width(Math.floor((100 * a.x) / d) + "%")
          : a.level.height(Math.floor((100 * a.y) / c));
        "function" == typeof a.opt.callback && a.opt.callback(a);
      }
    },
  };
  e.fn.simpleSlider = e.simpleSlider.init;
  e.fn.updateSliderVal = e.simpleSlider.updateSliderVal;
})(jQuery);
