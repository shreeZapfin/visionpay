define("@widget/LAYOUT/c/bs-headerTreatments-da62c771.js", ["exports"], (function(e) {
    "use strict";
    const {
        imageDimensionConfig: t,
        FIT_IMAGE: n,
        LANDSCAPE: r,
        CIRCLE: i
    } = (global.Core || guac["@wsb/guac-widget-core"]).constants.imageDimensions, o = t[r].aspectRatio, a = i, u = /[.-]wsimg\.com\//;

    function c(e) {
        return !!u.test(e)
    }

    function s(e) {
        return e ? e.split("/").filter(Boolean).map((e => {
            const [t, n] = e.split("=");
            return {
                name: t,
                value: n
            }
        })) : []
    }

    function l(e) {
        return null == e ? [] : "string" == typeof e ? s(e) : Array.isArray(e) ? e : Object.entries(e).map((([e, t]) => ({
            name: e,
            value: t
        })))
    }

    function g(e, t) {
        const n = function(e) {
            if (!c(e)) return null;
            const [t, n] = e.split("/:/");
            return {
                source: t,
                operations: s(n)
            }
        }(e);
        return null == n ? e : function({
            source: e,
            operations: t
        }) {
            if (null == t) return e;
            const n = t.map((({
                name: e,
                value: t
            }) => null == t ? e : `${e}=${t}`)).join("/");
            return n ? e + "/:/" + n : e
        }({
            source: n.source,
            operations: [...n.operations, ...l(t)]
        })
    }

    function d(e) {
        return c(e) ? e : function(e = "") {
            return e.split("/:/")[0]
        }(e)
    }
    const {
        headerTreatments: {
            FILL: m,
            FIT: p,
            INSET: f,
            BLUR: h,
            LEGACY_BLUR: w
        }
    } = (global.Core || guac["@wsb/guac-widget-core"]).constants;
    e.B = h, e.C = u, e.F = m, e.I = f, e.L = w, e.a = p, e.b = g, e.c = d, e.d = function(e, t) {
        return t.map((t => `${function(e,t){const{outputHeight:n,outputWidth:r,aspectRatio:i}=e;let o=Math.max(0,Math.min(r,t));const a=r/o;let u,c=Math.floor(n/a);return!r&&i&&(o=t,c=o/i),o&&(u=`
            w: $ {
                o
            }
            `,c&&(u+=`, h: $ {
                c
            }
            `),u+=",cg:true,m,i:true"),g("//img1.wsimg.com/isteam/ip/static/transparent_placeholder.png",{rs:u,qt:"q:1",ll:"n:true"})}(e,t)} ${t}w`))
    }, e.e = function(e, t, n) {
        return "string" == typeof((null == e ? void 0 : e.imageUrl) || (null == e ? void 0 : e.image)) ? d((global.Core || guac["@wsb/guac-widget-core"]).utils.generateImageServiceUrl(e)) : null != n && n.fallbackBackgroundImageSrc ? n.fallbackBackgroundImageSrc.replace(/\{(width|height)\}/g, "+0") : t || ""
    }, e.f = function(e = {}) {
        const {
            outputWidth: r,
            outputHeight: i,
            imageDimension: o,
            enableImageDimension: a
        } = e, u = {}, c = { ...e
        };
        if (o)
            if (o === n) delete c.outputHeight, delete c.editedAspectRatio, u.borderRadius = 0;
            else {
                const {
                    aspectRatio: e,
                    borderRadius: n
                } = t[o] || {};
                e && r ? c.outputHeight = r / e : e && i && (c.outputWidth = i * e), u.borderRadius = n
            }
        return {
            imageDimensionStyles: u,
            parsedImageData: c,
            enableImageDimension: a
        }
    }, e.g = function(e, t = !0) {
        return d(t ? (global.Core || guac["@wsb/guac-widget-core"]).utils.generateBackgroundUrl(e) : (global.Core || guac["@wsb/guac-widget-core"]).utils.generateBackgroundUrl(e).replace(/\/rs=w:{width},h:{height},cg:true,m\/cr=w:{width},h:{height},a[x]?:[^/]*/, "").replace(/\/:$/, ""))
    }, e.h = o, e.i = c, e.j = a, e.r = function(e, t = "") {
        return e && "string" == typeof e ? e.replace(/\/:\/rs=w:[0-9]*,h:[0-9]*/, t) : ""
    }
})), "undefined" != typeof window && (window.global = window);
//# sourceMappingURL=bs-headerTreatments-da62c771.js.map