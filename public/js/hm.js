(function() {
    var h = {}, mt = {}, c = {
        id: "32464c62d48217432782c817b1ae58ce",
        dm: ["sf-express.com"],
        js: "tongji.baidu.com/hm-web/js/",
        etrk: [{
            id: "indexQueryBill",
            eventType: "onclick"
        }
        ],
        icon: '',
        ctrk: false,
        align: - 1,
        nv: - 1,
        vdur: 1800000,
        age: 31536000000,
        rec: 1,
        rp: [],
        trust: 0,
        vcard: 0,
        qiao: 0,
        lxb: 0,
        conv: 0,
        comm: 0,
        apps: ''
    };
    var p=!0, q = null, r=!1;
    mt.i = {};
    mt.i.Fa = /msie (\d+\.\d+)/i.test(navigator.userAgent);
    mt.i.cookieEnabled = navigator.cookieEnabled;
    mt.i.javaEnabled = navigator.javaEnabled();
    mt.i.language = navigator.language || navigator.browserLanguage || navigator.systemLanguage || navigator.userLanguage || "";
    mt.i.Ha = (window.screen.width || 0) + "x" + (window.screen.height || 0);
    mt.i.colorDepth = window.screen.colorDepth || 0;
    mt.cookie = {};
    mt.cookie.set = function(a, b, e) {
        var d;
        e.H && (d = new Date, d.setTime(d.getTime() + e.H));
        document.cookie = a + "=" + b + (e.domain ? "; domain=" + e.domain : "") + (e.path ? "; path=" + e.path : "") + (d ? "; expires=" + d.toGMTString() : "") + (e.Ta ? "; secure" : "")
    };
    mt.cookie.get = function(a) {
        return (a = RegExp("(^| )" + a + "=([^;]*)(;|$)").exec(document.cookie)) ? a[2] : q
    };
    mt.m = {};
    mt.m.Q = function(a) {
        return document.getElementById(a)
    };
    mt.m.ra = function(a) {
        var b;
        for (b = "A"; (a = a.parentNode) && 1 == a.nodeType;)
            if (a.tagName == b)
                return a;
        return q
    };
    (mt.m.W = function() {
        function a() {
            if (!a.A) {
                a.A = p;
                for (var b = 0, g = d.length; b < g; b++)
                    d[b]()
            }
        }
        function b() {
            try {
                document.documentElement.doScroll("left")
            } catch (d) {
                setTimeout(b, 1);
                return 
            }
            a()
        }
        var e = r, d = [], g;
        document.addEventListener ? g = function() {
            document.removeEventListener("DOMContentLoaded", g, r);
            a()
        } : document.attachEvent && (g = function() {
            "complete" === document.readyState && (document.detachEvent("onreadystatechange", g), a())
        });
        (function() {
            if (!e)
                if (e = p, "complete" === document.readyState)
                    a.A = p;
                else if (document.addEventListener)
                    document.addEventListener("DOMContentLoaded",
                    g, r), window.addEventListener("load", a, r);
                else if (document.attachEvent) {
                    document.attachEvent("onreadystatechange", g);
                    window.attachEvent("onload", a);
                    var d = r;
                    try {
                        d = window.frameElement == q
                    } catch (l) {}
                    document.documentElement.doScroll && d && b()
                }
        })();
        return function(b) {
            a.A ? b() : d.push(b)
        }
    }()).A = r;
    mt.event = {};
    mt.event.c = function(a, b, e) {
        a.attachEvent ? a.attachEvent("on" + b, function(d) {
            e.call(a, d)
        }) : a.addEventListener && a.addEventListener(b, e, r)
    };
    mt.event.preventDefault = function(a) {
        a.preventDefault ? a.preventDefault() : a.returnValue = r
    };
    mt.p = {};
    mt.p.parse = function() {
        return (new Function('return (" + source + ")'))()
    };
    mt.p.stringify = function() {
        function a(a) {
            /["\\\x00-\x1f]/.test(a) && (a = a.replace(/["\\\x00-\x1f]/g, function(a) {
                var d = e[a];
                if (d)
                    return d;
                d = a.charCodeAt();
                return "\\u00" + Math.floor(d / 16).toString(16) + (d%16).toString(16)
            }));
            return '"' + a + '"'
        }
        function b(a) {
            return 10 > a ? "0" + a : a
        }
        var e = {
            "\b": "\\b",
            "\t": "\\t",
            "\n": "\\n",
            "\f": "\\f",
            "\r": "\\r",
            '"': '\\"',
            "\\": "\\\\"
        };
        return function(d) {
            switch (typeof d) {
            case "undefined":
                return "undefined";
            case "number":
                return isFinite(d) ? String(d) : "null";
            case "string":
                return a(d);
            case "boolean":
                return String(d);
            default:
                if (d === q)
                    return "null";
                if (d instanceof Array) {
                    var g = ["["], e = d.length, l, f, k;
                    for (f = 0; f < e; f++)
                        switch (k = d[f], typeof k) {
                        case "undefined":
                        case "function":
                        case "unknown":
                            break;
                        default:
                            l && g.push(","), g.push(mt.p.stringify(k)), l = 1
                        }
                    g.push("]");
                    return g.join("")
                }
                if (d instanceof Date)
                    return '"' + d.getFullYear() + "-" + b(d.getMonth() + 1) + "-" + b(d.getDate()) + "T" + b(d.getHours()) + ":" + b(d.getMinutes()) + ":" + b(d.getSeconds()) + '"';
                l = ["{"];
                f = mt.p.stringify;
                for (e in d)
                    if (Object.prototype.hasOwnProperty.call(d, e))
                        switch (k =
                        d[e], typeof k) {
                        case "undefined":
                        case "unknown":
                        case "function":
                            break;
                        default:
                            g && l.push(","), g = 1, l.push(f(e) + ":" + f(k))
                        }
                l.push("}");
                return l.join("")
            }
        }
    }();
    mt.lang = {};
    mt.lang.e = function(a, b) {
        return "[object " + b + "]" === {}.toString.call(a)
    };
    mt.lang.Qa = function(a) {
        return mt.lang.e(a, "Number") && isFinite(a)
    };
    mt.lang.Sa = function(a) {
        return mt.lang.e(a, "String")
    };
    mt.localStorage = {};
    mt.localStorage.F = function() {
        if (!mt.localStorage.f)
            try {
                mt.localStorage.f = document.createElement("input"), mt.localStorage.f.type = "hidden", mt.localStorage.f.style.display = "none", mt.localStorage.f.addBehavior("#default#userData"), document.getElementsByTagName("head")[0].appendChild(mt.localStorage.f)
        } catch (a) {
            return r
        }
        return p
    };
    mt.localStorage.set = function(a, b, e) {
        var d = new Date;
        d.setTime(d.getTime() + e || 31536E6);
        try {
            window.localStorage ? (b = d.getTime() + "|" + b, window.localStorage.setItem(a, b)) : mt.localStorage.F() && (mt.localStorage.f.expires = d.toUTCString(), mt.localStorage.f.load(document.location.hostname), mt.localStorage.f.setAttribute(a, b), mt.localStorage.f.save(document.location.hostname))
        } catch (g) {}
    };
    mt.localStorage.get = function(a) {
        if (window.localStorage) {
            if (a = window.localStorage.getItem(a)) {
                var b = a.indexOf("|"), e = a.substring(0, b) - 0;
                if (e && e > (new Date).getTime())
                    return a.substring(b + 1)
                }
        } else if (mt.localStorage.F())
            try {
                return mt.localStorage.f.load(document.location.hostname), mt.localStorage.f.getAttribute(a)
        } catch (d) {}
        return q
    };
    mt.localStorage.remove = function(a) {
        if (window.localStorage)
            window.localStorage.removeItem(a);
        else if (mt.localStorage.F())
            try {
                mt.localStorage.f.load(document.location.hostname), mt.localStorage.f.removeAttribute(a), mt.localStorage.f.save(document.location.hostname)
        } catch (b) {}
    };
    mt.sessionStorage = {};
    mt.sessionStorage.set = function(a, b) {
        if (window.sessionStorage)
            try {
                window.sessionStorage.setItem(a, b)
        } catch (e) {}
    };
    mt.sessionStorage.get = function(a) {
        return window.sessionStorage ? window.sessionStorage.getItem(a) : q
    };
    mt.sessionStorage.remove = function(a) {
        window.sessionStorage && window.sessionStorage.removeItem(a)
    };
    mt.Y = {};
    mt.Y.log = function(a, b) {
        var e = new Image, d = "mini_tangram_log_" + Math.floor(2147483648 * Math.random()).toString(36);
        window[d] = e;
        e.onload = e.onerror = e.onabort = function() {
            e.onload = e.onerror = e.onabort = q;
            e = window[d] = q;
            b && b(a)
        };
        e.src = a
    };
    mt.D = {};
    mt.D.xa = function() {
        var a = "";
        if (navigator.plugins && navigator.mimeTypes.length) {
            var b = navigator.plugins["Shockwave Flash"];
            b && b.description && (a = b.description.replace(/^.*\s+(\S+)\s+\S+$/, "$1"))
        } else if (window.ActiveXObject)
            try {
                if (b = new ActiveXObject("ShockwaveFlash.ShockwaveFlash"))(a = b.GetVariable("$version")) && (a = a.replace(/^.*\s+(\d+),(\d+).*$/, "$1.$2"))
                } catch (e) {}
                return a
    };
    mt.D.ka = function(a, b, e, d, g) {
        return '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="' + a + '" width="' + e + '" height="' + d + '"><param name="movie" value="' + b + '" /><param name="flashvars" value="' + (g || "") + '" /><param name="allowscriptaccess" value="always" /><embed type="application/x-shockwave-flash" name="' + a + '" width="' + e + '" height="' + d + '" src="' + b + '" flashvars="' + (g || "") + '" allowscriptaccess="always" /></object>'
    };
    mt.url = {};
    mt.url.l = function(a, b) {
        var e = a.match(RegExp("(^|&|\\?|#)(" + b + ")=([^&#]*)(&|$|#)", ""));
        return e ? e[3] : q
    };
    mt.url.Pa = function(a) {
        return (a = a.match(/^(https?:)\/\//)) ? a[1] : q
    };
    mt.url.ua = function(a) {
        return (a = a.match(/^(https?:\/\/)?([^\/\?#]*)/)) ? a[2].replace(/.*@/, "") : q
    };
    mt.url.S = function(a) {
        return (a = mt.url.ua(a)) ? a.replace(/:\d+$/, "") : a
    };
    mt.url.Oa = function(a) {
        return (a = a.match(/^(https?:\/\/)?[^\/]*(.*)/)) ? a[2].replace(/[\?#].*/, "").replace(/^$/, "/") : q
    };
    h.g = {
        Da: "http://tongji.baidu.com/hm-web/welcome/ico",
        M: "log.hm.baidu.com/hm.gif",
        ca: "baidu.com",
        Aa: "hmmd",
        Ba: "hmpl",
        za: "hmkw",
        ya: "hmci",
        Ca: "hmsr",
        q: 0,
        j: Math.round( + new Date / 1E3),
        protocol: "https:" == document.location.protocol ? "https:": "http:",
        Ra: 0,
        ha: 6E5,
        ia: 10,
        O: 1024,
        ga: 1,
        r: 2147483647,
        Z: "cc cf ci ck cl cm cp cw ds ep et fl ja ln lo lt nv rnd si st su v cv lv api tt u".split(" ")
    };
    (function() {
        var a = {
            o: {},
            c: function(a, e) {
                this.o[a] = this.o[a] || [];
                this.o[a].push(e)
            },
            w: function(a, e) {
                this.o[a] = this.o[a] || [];
                for (var d = this.o[a].length, g = 0; g < d; g++)
                    this.o[a][g](e)
            }
        };
        return h.k = a
    })();
    (function() {
        function a(a, d) {
            var g = document.createElement("script");
            g.charset = "utf-8";
            b.e(d, "Function") && (g.readyState ? g.onreadystatechange = function() {
                if ("loaded" === g.readyState || "complete" === g.readyState)
                    g.onreadystatechange = q, d()
            } : g.onload = function() {
                d()
            });
            g.src = a;
            var n = document.getElementsByTagName("script")[0];
            n.parentNode.insertBefore(g, n)
        }
        var b = mt.lang;
        return h.load = a
    })();
    (function() {
        function a() {
            var a = "";
            h.b.a.nv ? (a = encodeURIComponent(document.referrer), window.sessionStorage ? e.set("Hm_from_" + c.id, a) : b.set("Hm_from_" + c.id, a, 864E5)) : a = (window.sessionStorage ? e.get("Hm_from_" + c.id) : b.get("Hm_from_" + c.id)) || "";
            return a
        }
        var b = mt.localStorage, e = mt.sessionStorage;
        return h.P = a
    })();
    (function() {
        var a = h.g, b = mt.D, e = {
            init: function() {
                if ("" !== c.icon) {
                    var d;
                    d = c.icon.split("|");
                    var g = a.Da + "?s=" + c.id, e = ("http:" == a.protocol ? "http://eiv" : "https://bs") + ".baidu.com" + d[0] + "." + d[1];
                    switch (d[1]) {
                    case "swf":
                        d = b.ka("HolmesIcon" + a.j, e, d[2], d[3], "s=" + g);
                        break;
                    case "gif":
                        d = '<a href="' + g + '" target="_blank"><img border="0" src="' + e + '" width="' + d[2] + '" height="' + d[3] + '"></a>';
                        break;
                    default:
                        d = '<a href="' + g + '" target="_blank">' + d[0] + "</a>"
                    }
                    document.write(d)
                }
            }
        };
        h.k.c("pv-b", e.init);
        return e
    })();
    (function() {
        var a = mt.m, b = mt.event, e = {
            aa: function() {
                b.c(document, "click", e.ma());
                for (var d = c.etrk.length, g = 0; g < d; g++) {
                    var n = c.etrk[g], l = a.Q(decodeURIComponent(n.id));
                    l && b.c(l, n.eventType, e.na())
                }
            },
            na: function() {
                return function(a) {
                    (a.target || a.srcElement).setAttribute("HM_fix", a.clientX + ":" + a.clientY);
                    h.b.a.et = 1;
                    h.b.a.ep = "{id:" + this.id + ",eventType:" + a.type + "}";
                    h.b.h()
                }
            },
            ma: function() {
                return function(a) {
                    var b = a.target || a.srcElement;
                    if (b) {
                        var e = b.getAttribute("HM_fix"), l = a.clientX + ":" + a.clientY;
                        if (e &&
                        e == l)
                            b.removeAttribute("HM_fix");
                        else if (e = c.etrk.length, 0 < e) {
                            for (l = {}; b && b != document.body;)
                                b.id && (l[b.id] = ""), b = b.parentNode;
                            for (b = 0; b < e; b++) {
                                var f = decodeURIComponent(c.etrk[b].id);
                                l.hasOwnProperty(f) && (h.b.a.et = 1, h.b.a.ep = "{id:" + f + ",eventType:" + a.type + "}", h.b.h())
                            }
                        }
                    }
                }
            }
        };
        h.k.c("pv-b", e.aa);
        return e
    })();
    (function() {
        var a = mt.m, b = mt.event, e = mt.i, d = h.g, g = [], n = {
            $: function() {
                c.ctrk && (b.c(document, "mouseup", n.fa()), b.c(window, "unload", function() {
                    n.B()
                }), setInterval(function() {
                    n.B()
                }, d.ha))
            },
            fa: function() {
                return function(a) {
                    a = n.sa(a);
                    if ("" !== a) {
                        var b = (d.protocol + "//" + d.M + "?" + h.b.X().replace(/ep=[^&]*/, "ep=" + encodeURIComponent("[" + a + "]"))).length;
                        b + (d.r + "").length > d.O || (b + encodeURIComponent(g.join(",") + (g.length ? "," : "")).length + (d.r + "").length > d.O && n.B(), g.push(a), (g.length >= d.ia || /t:a/.test(a)) && n.B())
                    }
                }
            },
            sa: function(b) {
                if (0 === d.ga) {
                    var f = b.target || b.srcElement, k = f.tagName.toLowerCase();
                    if ("embed" == k || "object" == k)
                        return ""
                }
                e.Fa ? (f = Math.max(document.documentElement.scrollTop, document.body.scrollTop), k = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft), k = b.clientX + k, f = b.clientY + f) : (k = b.pageX, f = b.pageY);
                var m = window.innerWidth || document.documentElement.clientWidth || document.body.offsetWidth;
                switch (c.align) {
                case 1:
                    k -= m / 2;
                    break;
                case 2:
                    k -= m
                }
                k = "{x:" + k + ",y:" + f + ",";
                f = b.target || b.srcElement;
                return k = (b = "a" == f.tagName.toLowerCase() ? f : a.ra(f)) ? k + ("t:a,u:" + encodeURIComponent(b.href) + "}") : k + "t:b}"
            },
            B: function() {
                0 !== g.length && (h.b.a.et = 2, h.b.a.ep = "[" + g.join(",") + "]", h.b.h(), g = [])
            }
        };
        h.k.c("pv-b", n.$);
        return n
    })();
    (function() {
        var a = mt.m, b = h.g, e = h.load, d = h.P;
        h.k.c("pv-b", function() {
            c.rec && a.W(function() {
                for (var g = 0, n = c.rp.length; g < n; g++) {
                    var l = c.rp[g][0], f = c.rp[g][1], k = a.Q("hm_t_" + l);
                    if (f&&!(2 == f&&!k || k && "" !== k.innerHTML))
                        k = "", k = Math.round(Math.random() * b.r), k = 4 == f ? "http://crs.baidu.com/hl.js?" + ["siteId=" + c.id, "planId=" + l, "rnd=" + k].join("&") : "http://crs.baidu.com/t.js?" + ["siteId=" + c.id, "planId=" + l, "from=" + d(), "referer=" + encodeURIComponent(document.referrer), "title=" + encodeURIComponent(document.title), "rnd=" +
                        k].join("&"), e(k)
                }
            })
        })
    })();
    (function() {
        var a = h.g, b = h.load, e = h.P;
        h.k.c("pv-b", function() {
            if (c.trust && c.vcard) {
                var d = a.protocol + "//trust.baidu.com/vcard/v.js?" + ["siteid=" + c.vcard, "url=" + encodeURIComponent(document.location.href), "source=" + e(), "rnd=" + Math.round(Math.random() * a.r)].join("&");
                b(d)
            }
        })
    })();
    (function() {
        function a() {
            return function() {
                h.b.a.nv = 0;
                h.b.a.st = 4;
                h.b.a.et = 3;
                h.b.a.ep = h.G.va() + "," + h.G.ta();
                h.b.h()
            }
        }
        function b() {
            clearTimeout(A);
            var a;
            y && (a = "visible" == document[y]);
            B && (a=!document[B]);
            f = "undefined" == typeof a ? p : a;
            if ((!l ||!k) && f && m)
                u = p, t =+ new Date;
            else if (l && k && (!f ||!m))
                u = r, s+=+new Date - t;
            l = f;
            k = m;
            A = setTimeout(b, 100)
        }
        function e(a) {
            var k = document, t = "";
            if (a in k)
                t = a;
            else 
                for (var b = ["webkit", "ms", "moz", "o"], d = 0; d < b.length; d++) {
                    var s = b[d] + a.charAt(0).toUpperCase() + a.slice(1);
                    if (s in k) {
                        t =
                        s;
                        break
                    }
                }
            return t
        }
        function d(a) {
            if (!("focus" == a.type || "blur" == a.type) ||!(a.target && a.target != window))
                m = "focus" == a.type || "focusin" == a.type ? p : r, b()
        }
        var g = mt.event, n = h.k, l = p, f = p, k = p, m = p, v =+ new Date, t = v, s = 0, u = p, y = e("visibilityState"), B = e("hidden"), A;
        b();
        (function() {
            var a = y.replace(/[vV]isibilityState/, "visibilitychange");
            g.c(document, a, b);
            g.c(window, "pageshow", b);
            g.c(window, "pagehide", b);
            "object" == typeof document.onfocusin ? (g.c(document, "focusin", d), g.c(document, "focusout", d)) : (g.c(window, "focus", d),
            g.c(window, "blur", d))
        })();
        h.G = {
            va: function() {
                return + new Date - v
            },
            ta: function() {
                return u?+new Date - t + s : s
            }
        };
        n.c("pv-b", function() {
            g.c(window, "unload", a())
        });
        return h.G
    })();
    (function() {
        var a = mt.lang, b = h.g, e = h.load, d = {
            Ea: function(d) {
                if ((void 0 === window._dxt || a.e(window._dxt, "Array")) && "undefined" !== typeof h.b) {
                    var n = h.b.I();
                    e([b.protocol, "//datax.baidu.com/x.js?si=", c.id, "&dm=", encodeURIComponent(n)].join(""), d)
                }
            },
            Ma: function(b) {
                if (a.e(b, "String") || a.e(b, "Number"))
                    window._dxt = window._dxt || [], window._dxt.push(["_setUserId", b])
            }
        };
        return h.la = d
    })();
    (function() {
        function a(k) {
            for (var b in k)
                if ({}.hasOwnProperty.call(k, b)) {
                    var d = k[b];
                    e.e(d, "Object") || e.e(d, "Array") ? a(d) : k[b] = String(d)
                }
        }
        function b(a) {
            return a.replace ? a.replace(/'/g, "'0").replace(/\*/g, "'1").replace(/!/g, "'2") : a
        }
        var e = mt.lang, d = mt.p, g = h.g, n = h.k, l = h.la, f = {
            T: q,
            s: [],
            C: 0,
            U: r,
            init: function() {
                f.d = 0;
                f.T = {
                    push: function() {
                        f.L.apply(f, arguments)
                    }
                };
                n.c("pv-b", function() {
                    f.oa();
                    f.pa()
                });
                n.c("pv-d", f.qa);
                n.c("stag-b", function() {
                    h.b.a.api = f.d || f.C ? f.d + "_" + f.C : ""
                });
                n.c("stag-d", function() {
                    h.b.a.api =
                    0;
                    f.d = 0;
                    f.C = 0
                })
            },
            oa: function() {
                var a = window._hmt;
                if (a && a.length)
                    for (var b = 0; b < a.length; b++) {
                        var d = a[b];
                        switch (d[0]) {
                        case "_setAccount":
                            1 < d.length && /^[0-9a-z]{32}$/.test(d[1]) && (f.d|=1, window._bdhm_account = d[1]);
                            break;
                        case "_setAutoPageview":
                            if (1 < d.length && (d = d[1], r === d || p === d))
                                f.d|=2, window._bdhm_autoPageview = d
                        }
                    }
            },
            pa: function() {
                if ("undefined" === typeof window._bdhm_account || window._bdhm_account === c.id) {
                    window._bdhm_account = c.id;
                    var a = window._hmt;
                    if (a && a.length)
                        for (var b = 0, d = a.length; b < d; b++)
                            e.e(a[b],
                            "Array") && "_trackEvent" !== a[b][0] && "_trackRTEvent" !== a[b][0] ? f.L(a[b]) : f.s.push(a[b]);
                    window._hmt = f.T
                }
            },
            qa: function() {
                if (0 < f.s.length)
                    for (var a = 0, b = f.s.length; a < b; a++)
                        f.L(f.s[a]);
                f.s = q
            },
            L: function(a) {
                if (e.e(a, "Array")) {
                    var b = a[0];
                    if (f.hasOwnProperty(b) && e.e(f[b], "Function"))
                        f[b](a)
                }
            },
            _trackPageview: function(a) {
                if (1 < a.length && a[1].charAt && "/" == a[1].charAt(0)) {
                    f.d|=4;
                    h.b.a.et = 0;
                    h.b.a.ep = "";
                    h.b.J ? (h.b.a.nv = 0, h.b.a.st = 4) : h.b.J = p;
                    var b = h.b.a.u, d = h.b.a.su;
                    h.b.a.u = g.protocol + "//" + document.location.host +
                    a[1];
                    f.U || (h.b.a.su = document.location.href);
                    h.b.h();
                    h.b.a.u = b;
                    h.b.a.su = d
                }
            },
            _trackEvent: function(a) {
                2 < a.length && (f.d|=8, h.b.a.nv = 0, h.b.a.st = 4, h.b.a.et = 4, h.b.a.ep = b(a[1]) + "*" + b(a[2]) + (a[3] ? "*" + b(a[3]) : "") + (a[4] ? "*" + b(a[4]) : ""), h.b.h())
            },
            _setCustomVar: function(a) {
                if (!(4 > a.length)) {
                    var d = a[1], e = a[4] || 3;
                    if (0 < d && 6 > d && 0 < e && 4 > e) {
                        f.C++;
                        for (var t = (h.b.a.cv || "*").split("!"), s = t.length; s < d - 1; s++)
                            t.push("*");
                        t[d - 1] = e + "*" + b(a[2]) + "*" + b(a[3]);
                        h.b.a.cv = t.join("!");
                        a = h.b.a.cv.replace(/[^1](\*[^!]*){2}/g, "*").replace(/((^|!)\*)+$/g,
                        "");
                        "" !== a ? h.b.setData("Hm_cv_" + c.id, encodeURIComponent(a), c.age) : h.b.Ga("Hm_cv_" + c.id)
                    }
                }
            },
            _setReferrerOverride: function(a) {
                1 < a.length && (h.b.a.su = a[1].charAt && "/" == a[1].charAt(0) ? g.protocol + "//" + window.location.host + a[1] : a[1], f.U = p)
            },
            _trackOrder: function(b) {
                b = b[1];
                e.e(b, "Object") && (a(b), f.d|=16, h.b.a.nv = 0, h.b.a.st = 4, h.b.a.et = 94, h.b.a.ep = d.stringify(b), h.b.h())
            },
            _trackMobConv: function(a) {
                if (a = {
                    webim: 1,
                    tel: 2,
                    map: 3,
                    sms: 4,
                    callback: 5,
                    share: 6
                }
                [a[1]])
                    f.d|=32, h.b.a.et = 93, h.b.a.ep = a, h.b.h()
            },
            _trackRTPageview: function(b) {
                b =
                b[1];
                e.e(b, "Object") && (a(b), b = d.stringify(b), 512 >= encodeURIComponent(b).length && (f.d|=64, h.b.a.rt = b))
            },
            _trackRTEvent: function(b) {
                b = b[1];
                if (e.e(b, "Object")) {
                    a(b);
                    b = encodeURIComponent(d.stringify(b));
                    var m = function(a) {
                        var b = h.b.a.rt;
                        f.d|=128;
                        h.b.a.et = 90;
                        h.b.a.rt = a;
                        h.b.h();
                        h.b.a.rt = b
                    }, l = b.length;
                    if (900 >= l)
                        m.call(this, b);
                    else 
                        for (var l = Math.ceil(l / 900), t = "block|" + Math.round(Math.random() * g.r).toString(16) + "|" + l + "|", s = [], u = 0; u < l; u++)
                            s.push(u), s.push(b.substring(900 * u, 900 * u + 900)), m.call(this, t + s.join("|")),
                            s = []
                }
            },
            _setUserId: function(a) {
                a = a[1];
                l.Ea();
                l.Ma(a)
            }
        };
        f.init();
        h.da = f;
        return h.da
    })();
    (function() {
        function a() {
            "undefined" == typeof window["_bdhm_loaded_" + c.id] && (window["_bdhm_loaded_" + c.id] = p, this.a = {}, this.J = r, this.init())
        }
        var b = mt.url, e = mt.Y, d = mt.D, g = mt.lang, n = mt.cookie, l = mt.i, f = mt.localStorage, k = mt.sessionStorage, m = h.g, v = h.k;
        a.prototype = {
            K: function(a, b) {
                a = "." + a.replace(/:\d+/, "");
                b = "." + b.replace(/:\d+/, "");
                var d = a.indexOf(b);
                return - 1 < d && d + b.length == a.length
            },
            V: function(a, b) {
                a = a.replace(/^https?:\/\//, "");
                return 0 === a.indexOf(b)
            },
            z: function(a) {
                for (var d = 0; d < c.dm.length; d++)
                    if ( - 1 <
                    c.dm[d].indexOf("/")) {
                        if (this.V(a, c.dm[d]))
                            return p
                    } else {
                        var e = b.S(a);
                        if (e && this.K(e, c.dm[d]))
                            return p
                    }
                return r
            },
            I: function() {
                for (var a = document.location.hostname, b = 0, d = c.dm.length; b < d; b++)
                    if (this.K(a, c.dm[b]))
                        return c.dm[b].replace(/(:\d+)?[\/\?#].*/, "");
                return a
            },
            R: function() {
                for (var a = 0, b = c.dm.length; a < b; a++) {
                    var d = c.dm[a];
                    if ( - 1 < d.indexOf("/") && this.V(document.location.href, d))
                        return d.replace(/^[^\/]+(\/.*)/, "$1") + "/"
                }
                return "/"
            },
            wa: function() {
                if (!document.referrer)
                    return m.j - m.q > c.vdur ? 1 : 4;
                var a =
                r;
                this.z(document.referrer) && this.z(document.location.href) ? a = p : (a = b.S(document.referrer), a = this.K(a || "", document.location.hostname));
                return a ? m.j - m.q > c.vdur ? 1 : 4 : 3
            },
            getData: function(a) {
                try {
                    return n.get(a) || k.get(a) || f.get(a)
                } catch (b) {}
            },
            setData: function(a, b, d) {
                try {
                    n.set(a, b, {
                        domain: this.I(),
                        path: this.R(),
                        H: d
                    }), d ? f.set(a, b, d) : k.set(a, b)
                } catch (e) {}
            },
            Ga: function(a) {
                try {
                    n.set(a, "", {
                        domain: this.I(),
                        path: this.R(),
                        H: - 1
                    }), k.remove(a), f.remove(a)
                } catch (b) {}
            },
            Ka: function() {
                var a, b, d, e, f;
                m.q = this.getData("Hm_lpvt_" +
                c.id) || 0;
                13 == m.q.length && (m.q = Math.round(m.q / 1E3));
                b = this.wa();
                a = 4 != b ? 1 : 0;
                if (d = this.getData("Hm_lvt_" + c.id)) {
                    e = d.split(",");
                    for (f = e.length - 1; 0 <= f; f--)
                        13 == e[f].length && (e[f] = "" + Math.round(e[f] / 1E3));
                    for (; 2592E3 < m.j - e[0];)
                        e.shift();
                    f = 4 > e.length ? 2 : 3;
                    for (1 === a && e.push(m.j); 4 < e.length;)
                        e.shift();
                    d = e.join(",");
                    e = e[e.length - 1]
                } else 
                    d = m.j, e = "", f = 1;
                this.setData("Hm_lvt_" + c.id, d, c.age);
                this.setData("Hm_lpvt_" + c.id, m.j);
                d = m.j == this.getData("Hm_lpvt_" + c.id) ? "1" : "0";
                if (0 === c.nv && this.z(document.location.href) &&
                ("" === document.referrer || this.z(document.referrer)))
                    a = 0, b = 4;
                this.a.nv = a;
                this.a.st = b;
                this.a.cc = d;
                this.a.lt = e;
                this.a.lv = f
            },
            X: function() {
                for (var a = [], b = 0, d = m.Z.length; b < d; b++) {
                    var e = m.Z[b], f = this.a[e];
                    "undefined" != typeof f && "" !== f && a.push(e + "=" + encodeURIComponent(f))
                }
                b = this.a.et;
                this.a.rt && (0 === b ? a.push("rt=" + encodeURIComponent(this.a.rt)) : 90 === b && a.push("rt=" + this.a.rt));
                return a.join("&")
            },
            La: function() {
                this.Ka();
                this.a.si = c.id;
                this.a.su = document.referrer;
                this.a.ds = l.Ha;
                this.a.cl = l.colorDepth + "-bit";
                this.a.ln = l.language;
                this.a.ja = l.javaEnabled ? 1 : 0;
                this.a.ck = l.cookieEnabled ? 1 : 0;
                this.a.lo = "number" == typeof _bdhm_top ? 1 : 0;
                this.a.fl = d.xa();
                this.a.v = "1.0.94";
                this.a.cv = decodeURIComponent(this.getData("Hm_cv_" + c.id) || "");
                1 == this.a.nv && (this.a.tt = document.title || "");
                var a = document.location.href;
                this.a.cm = b.l(a, m.Aa) || "";
                this.a.cp = b.l(a, m.Ba) || "";
                this.a.cw = b.l(a, m.za) || "";
                this.a.ci = b.l(a, m.ya) || "";
                this.a.cf = b.l(a, m.Ca) || ""
            },
            init: function() {
                try {
                    this.La(), 0 === this.a.nv ? this.Ja() : this.N(".*"), h.b = this, this.ea(),
                    v.w("pv-b"), this.Ia()
                } catch (a) {
                    var b = [];
                    b.push("si=" + c.id);
                    b.push("n=" + encodeURIComponent(a.name));
                    b.push("m=" + encodeURIComponent(a.message));
                    b.push("r=" + encodeURIComponent(document.referrer));
                    e.log(m.protocol + "//" + m.M + "?" + b.join("&"))
                }
            },
            Ia: function() {
                function a() {
                    v.w("pv-d")
                }
                "undefined" === typeof window._bdhm_autoPageview || window._bdhm_autoPageview === p ? (this.J = p, this.a.et = 0, this.a.ep = "", this.h(a)) : a()
            },
            h: function(a) {
                var b = this;
                b.a.rnd = Math.round(Math.random() * m.r);
                v.w("stag-b");
                var d = m.protocol + "//" +
                m.M + "?" + b.X();
                v.w("stag-d");
                b.ba(d);
                e.log(d, function(d) {
                    b.N(d);
                    g.e(a, "Function") && a.call(b)
                })
            },
            ea: function() {
                var a = document.location.hash.substring(1), d = RegExp(c.id), e =- 1 < document.referrer.indexOf(m.ca) ? p : r, f = b.l(a, "jn"), g = /^heatlink$|^select$/.test(f);
                a && (d.test(a) && e && g) && (a = document.createElement("script"), a.setAttribute("type", "text/javascript"), a.setAttribute("charset", "utf-8"), a.setAttribute("src", m.protocol + "//" + c.js + f + ".js?" + this.a.rnd), f = document.getElementsByTagName("script")[0], f.parentNode.insertBefore(a,
                f))
            },
            ba: function(a) {
                var b = k.get("Hm_unsent_" + c.id) || "", d = this.a.u ? "": "&u=" + encodeURIComponent(document.location.href), b = encodeURIComponent(a.replace(/^https?:\/\//, "") + d) + (b ? "," + b : "");
                k.set("Hm_unsent_" + c.id, b)
            },
            N: function(a) {
                var b = k.get("Hm_unsent_" + c.id) || "";
                b && ((b = b.replace(RegExp(encodeURIComponent(a.replace(/^https?:\/\//, "")).replace(/([\*\(\)])/g, "\\$1") + "(%26u%3D[^,]*)?,?", "g"), "").replace(/,$/, "")) ? k.set("Hm_unsent_" + c.id, b) : k.remove("Hm_unsent_" + c.id))
            },
            Ja: function() {
                var a = this, b = k.get("Hm_unsent_" +
                c.id);
                if (b)
                    for (var b = b.split(","), d = function(b) {
                        e.log(m.protocol + "//" + decodeURIComponent(b).replace(/^https?:\/\//, ""), function(b) {
                            a.N(b)
                        })
                    }, f = 0, g = b.length; f < g; f++)
                        d(b[f])
            }
        };
        return new a
    })();
    var w = h.g, x = h.load;
    if (c.apps) {
        var z = [w.protocol, "//ers.baidu.com/app/s.js?"];
        z.push(c.apps);
        x(z.join(""))
    }
    var C = h.g, D = h.load;
    if (c.conv && "http:" === C.protocol) {
        var E = ["http://page.baidu.com/conversion_js.php?sid="];
        E.push(c.conv);
        D(E.join(""))
    }
    var F = h.g, G = h.load;
    c.lxb && G([F.protocol, "//lxbjs.baidu.com/lxb.js?sid=", c.lxb].join(""));
    var H = h.load, I = h.g.protocol;
    if (c.qiao) {
        for (var J = [I + "//goutong.baidu.com/site/"], K = c.id, L = 5381, M = K.length, N = 0; N < M; N++)
            L = (33 * L + Number(K.charCodeAt(N)))%4294967296;
        2147483648 < L && (L -= 2147483648);
        J.push(L%1E3 + "/");
        J.push(c.id + "/b.js");
        J.push("?siteId=" + c.qiao);
        H(J.join(""))
    }(function() {
        var a = mt.m, b = mt.event, e = mt.url, d = mt.p;
        try {
            if (window.performance && performance.timing && "undefined" !== typeof h.b) {
                var g =+ new Date, n = function(a) {
                    var b = performance.timing, d = b[a + "Start"] ? b[a + "Start"]: 0;
                    a = b[a + "End"] ? b[a + "End"] : 0;
                    return {
                        start: d,
                        end: a,
                        value: 0 < a - d ? a - d: 0
                    }
                }, l = q;
                a.W(function() {
                    l =+ new Date
                });
                var f = function() {
                    var a, b, f;
                    f = n("navigation");
                    b = n("request");
                    f = {
                        netAll: b.start - f.start,
                        netDns: n("domainLookup").value,
                        netTcp: n("connect").value,
                        srv: n("response").start - b.start,
                        dom: performance.timing.domInteractive -
                        performance.timing.fetchStart,
                        loadEvent: n("loadEvent").end - f.start
                    };
                    a = document.referrer;
                    var k = q;
                    b = q;
                    if ("www.baidu.com" === (a.match(/^(http[s]?:\/\/)?([^\/]+)(.*)/) || [])[2])
                        k = e.l(a, "qid"), b = e.l(a, "click_t");
                    a = k;
                    f.qid = a != q ? a : "";
                    b != q ? (f.bdDom = l ? l - b : 0, f.bdRun = g - b, f.bdDef = n("navigation").start - b) : (f.bdDom = 0, f.bdRun = 0, f.bdDef = 0);
                    h.b.a.et = 87;
                    h.b.a.ep = d.stringify(f);
                    h.b.h()
                };
                b.c(window, "load", function() {
                    setTimeout(f, 500)
                })
            }
        } catch (k) {}
    })();
    (function() {
        var a = h.g, b = {
            init: function() {
                try {
                    if ("http:" === a.protocol) {
                        var b = document.createElement("IFRAME");
                        b.setAttribute("src", "http://boscdn.bpc.baidu.com/v1/holmes-moplus/mp-cdn.html");
                        b.style.display = "none";
                        b.style.width = "1";
                        b.style.height = "1";
                        b.Na = "0";
                        document.body.appendChild(b)
                    }
                } catch (e) {}
            }
        }, e = navigator.userAgent.toLowerCase();
        - 1 < e.indexOf("android")&&-1 === e.indexOf("micromessenger") && b.init()
    })();
    (function() {
        var a = mt.lang, b = mt.event, e = mt.p;
        if (c.comm && "undefined" !== typeof h.b) {
            var d = function(a) {
                if (a.item) {
                    for (var b = a.length, d = Array(b); b--;)
                        d[b] = a[b];
                    return d
                }
                return [].slice.call(a)
            }, g = /.*\/swt(\/)?([\?|#].*)?$/i, n = {
                click: function() {
                    for (var a = [], b = d(document.getElementsByTagName("a")), b = [].concat.apply(b, d(document.getElementsByTagName("area"))), b = [].concat.apply(b, d(document.getElementsByTagName("img"))), e = /openZoosUrl\(|swt/, f = /\/LR\/Chatpre\.aspx/, k = 0, l = b.length; k < l; k++) {
                        var m = b[k], n = m.getAttribute("onclick"),
                        m = m.getAttribute("href");
                        (e.test(n) || f.test(m) || g.test(m)) && a.push(b[k])
                    }
                    return a
                }
            }, l = function(a, b) {
                for (var d in a)
                    if (a.hasOwnProperty(d) && b.call(a, d, a[d]) === r)
                        return r
            }, f = function(b, d) {
                var f = {
                    n: "swt",
                    t: "clk"
                };
                f.v = b;
                if (d) {
                    var k = d.getAttribute("href"), l = d.getAttribute("onclick") ? "" + d.getAttribute("onclick"): q;
                    g.test(k) ? (f.sn = "mediate", f.snv = k) : a.e(l, "String") && ( - 1 === l.indexOf("openZoosUrl")&&-1 !== l.indexOf("swt")) && (k = d.getAttribute("id") || "", f.sn = "wrap", f.snv = l, f.id = k)
                }
                h.b.a.et = 86;
                h.b.a.ep = e.stringify(f);
                h.b.h();
                for (f =+ new Date; 500>=+new Date - f;);
            }, k, m = "/zoosnet" + (/\/$/.test("/zoosnet") ? "" : "/"), v = function(b, d) {
                if (k === d)
                    return f(m + b, d), r;
                if (a.e(d, "Array") || a.e(d, "NodeList"))
                    for (var e = 0, g = d.length; e < g; e++)
                        if (k === d[e])
                            return f(m + b + "/" + (e + 1), d[e]), r
            };
            b.c(document, "click", function(b) {
                b = b || window.event;
                k = b.target || b.srcElement;
                var d = {};
                for (l(n, function(b, e) {
                    d[b] = a.e(e, "Function") ? e() : document.getElementById(e)
                });
                k && k !== document && l(d, v) !== r;
                )k = k.parentNode
            })
        }
    })();
})();


