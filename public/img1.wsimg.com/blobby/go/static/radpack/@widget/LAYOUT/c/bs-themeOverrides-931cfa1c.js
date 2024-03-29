define("@widget/LAYOUT/c/bs-themeOverrides-931cfa1c.js", ["exports"], (function(t) {
    "use strict";
    (global.Core || guac["@wsb/guac-widget-core"]).constants;
    t.a = ({
        sectionHeadingHR: t
    }) => t ? {
        sectionHeadingHR: t
    } : {}, t.b = ({
        sectionHeadingColor: t
    }) => ({
        HIGHLIGHT: {
            style: {
                color: "highlight"
            }
        },
        HIGH_CONTRAST: {
            style: {
                color: "highContrast"
            }
        }
    }[t] || {}), t.c = ({
        sectionHeadingSize: t
    }) => t ? {
        style: {
            fontSize: t
        }
    } : {}, t.s = ({
        sectionHeadingAlignment: t
    }) => ({
        LEFT: {
            style: {
                textAlign: "left",
                "@md": {
                    textAlign: "left"
                }
            },
            alignmentOption: "left"
        },
        CENTER: {
            style: {
                textAlign: "center",
                "@md": {
                    textAlign: "center"
                }
            },
            alignmentOption: "center"
        },
        RIGHT: {
            style: {
                textAlign: "right",
                "@md": {
                    textAlign: "right"
                }
            },
            alignmentOption: "right"
        }
    }[t] || {})
})), "undefined" != typeof window && (window.global = window);
//# sourceMappingURL=bs-themeOverrides-931cfa1c.js.map