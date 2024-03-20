define("@widget/MESSAGING/bs-Component-9afcd6f1.js", ["radpack", "exports", "@wsb/guac-widget-shared@^1/lib/components/Recaptcha/badge", "@wsb/guac-widget-shared@^1/lib/common/constants/traffic2", "@wsb/guac-widget-shared@^1/lib/common/constants/form/formIdentifiers"], (function(e, a, t, o, l) {
    "use strict";
    var r = (global.keyMirror || guac.keymirror)({
        MESSAGING_FAB: null,
        MESSAGING_MESSAGE_FLYOUT: null,
        WELCOME_MESSAGE: null,
        SEND_MESSAGE_TO: null,
        EMAIL_OPT_IN_TOGGLE: null,
        EMAIL_OPT_IN_MESSAGE: null
    });

    function c({
        text: e
    }) {
        return (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Block, {
            category: "neutral",
            section: "overlay",
            style: {
                backgroundColor: "neutral",
                margin: "-medium medium medium medium",
                borderRadius: "5px",
                position: "relative"
            }
        }, (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Text, {
            style: {
                padding: "12px 15px",
                borderRadius: "5px",
                backgroundColor: "primaryOverlay",
                fontSize: "16px",
                color: "neutral"
            }
        }, e), (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Element, {
            tag: "svg",
            width: "33px",
            height: "16px",
            viewBox: "0 0 33 16",
            style: {
                fill: "primaryOverlay",
                position: "absolute",
                top: "100%",
                left: "3px",
                marginTop: "-1px"
            },
            xmlns: "http://www.w3.org/2000/svg"
        }, (global.React || guac.react).createElement("path", {
            d: "M0.342304 14.5C7.35025 6.3293 3.35025 0.829295 0 0.0.0 0.0 5.4 2.1 32.3502 0.329295C32.3503 3.8293 -3.13481 20.7261 0.342304 14.5Z"
        })))
    }

    function i({
        title: e,
        message: a,
        children: t,
        onClose: o
    }) {
        return (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Block, {
            "data-aid": r.MESSAGING_MESSAGE_FLYOUT,
            style: {
                "-webkit-overflow-scrolling": "touch",
                overflowX: "hidden",
                overflowY: "auto",
                boxShadow: "0px 3px 18px rgba(0, 0, 0, 0.25)",
                backgroundColor: "neutral",
                borderRadius: "5px",
                borderWidth: "xsmall",
                borderStyle: "solid",
                borderColor: "#fff",
                width: "382px",
                marginBottom: "small",
                position: "absolute",
                maxHeight: "calc(100vh - 105px)",
                right: "-1px",
                bottom: "100%",
                "@xs-only": {
                    maxHeight: "100vh",
                    height: "100vh",
                    zIndex: "inherit",
                    position: "fixed",
                    left: "0",
                    top: "0",
                    bottom: "89px",
                    width: "100%"
                }
            }
        }, (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Block, {
            "data-field-id": "formEmail"
        }, (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Icon, {
            onClick: o,
            icon: "close",
            size: 22,
            style: {
                color: "#fff",
                position: "absolute",
                top: "18px",
                right: "14px",
                cursor: "pointer",
                "@sm": {
                    display: "none"
                }
            }
        }), (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Heading, {
            style: {
                color: "action",
                fontSize: "large",
                backgroundColor: "action",
                paddingTop: "small",
                paddingBottom: a ? "xlarge" : "small",
                paddingLeft: "medium",
                paddingRight: "medium",
                margin: a ? "0" : "0 0 medium 0",
                textAlign: "left",
                "@md": {
                    textAlign: "left"
                }
            }
        }, e), a ? (global.React || guac.react).createElement(c, {
            text: a
        }) : null, (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Block, {
            style: {
                overflow: "hidden",
                padding: "0 medium"
            }
        }, t)))
    }
    c.propTypes = {
        text: (global.PropTypes || guac["prop-types"]).string.isRequired
    }, i.propTypes = {
        title: (global.PropTypes || guac["prop-types"]).string.isRequired,
        message: (global.PropTypes || guac["prop-types"]).string.isRequired,
        children: (global.PropTypes || guac["prop-types"]).node.isRequired,
        onClose: (global.PropTypes || guac["prop-types"]).func.isRequired
    };
    const g = {
        contactApi: /[?&]contactApiVersion=([^&]*)/
    };

    function s(e = "contactApi") {
        if ("undefined" == typeof window) return "";
        const {
            location: {
                search: a = ""
            }
        } = window || {}, t = g[e].exec(a);
        return t && t[1] ? `${t[1]}.` : ""
    }
    const n = "EMAIL",
        {
            utils: {
                TCCLUtils: p
            }
        } = (global.Core || guac["@wsb/guac-widget-core"]).UX2,
        {
            MESSAGING_EMAIL: u,
            MESSAGING_CONVERSATIONS: d
        } = l.default,
        {
            Z_INDEX_COOKIE_BANNER: m,
            Z_INDEX_FULL_SCREEN_OVERLAY: b,
            Z_INDEX_STICKY_NAV: y
        } = (global.Core || guac["@wsb/guac-widget-core"]).constants.layers,
        f = ({
            keyName: e
        }) => "phone" !== e,
        E = (global.React || guac.react).lazy((() => new Promise((function(a, t) {
            e.require(["@wsb/guac-widget-shared@^1/lib/components/Form"], a, t)
        })))),
        w = {
            marginBottom: "medium",
            display: "block",
            textAlign: "center",
            color: "action"
        };

    function x(e, {
        renderMode: a
    }) {
        const {
            id: l,
            section: c,
            isMobile: g,
            forceShowFlyout: x,
            welcomeMessage: S,
            config: h,
            formEmail: R,
            formFields: T,
            formSuccessMessage: C,
            emailOptInEnabled: I,
            emailOptInMessage: M,
            notificationPreference: P,
            recaptchaType: _,
            emailConfirmationMessage: A,
            locale: N,
            websiteId: G,
            accountId: k,
            domainName: O,
            staticContent: v,
            isReseller: U,
            businessName: X
        } = e, B = (global.React || guac.react).useRef(!1), [L, F] = (global.React || guac.react).useState(x), q = () => F(!L);
        (global.React || guac.react).useEffect((() => {
            L !== x && F(x)
        }), [x]), (global.React || guac.react).useEffect((() => {
            B.current ? F(!0) : B.current = !0
        }), [R, S, C, I, M]);
        const z = P === n ? T.filter(f) : T,
            H = P === n ? u : d;
        return (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Block, {
            category: "neutral",
            section: c,
            style: {
                position: "fixed",
                right: "medium",
                bottom: "medium",
                zIndex: L ? b : m - 1,
                width: "65px",
                height: "65px",
                "@md": {
                    zIndex: L ? y + 1 : m - 1
                }
            }
        }, L ? (global.React || guac.react).createElement(i, {
            title: X,
            message: S,
            onClose: q
        }, "undefined" != typeof window ? (global.React || guac.react).createElement((global.React || guac.react).Suspense, {
            fallback: (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Block, {
                style: w
            }, (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Loader, {
                size: "medium"
            }))
        }, (global.React || guac.react).createElement(E, {
            locale: N,
            websiteId: G,
            accountId: k,
            domainName: O,
            staticContent: v,
            emailConfirmationMessage: A,
            emailOptInEnabled: I,
            emailOptInMessage: M,
            formSuccessMessage: C,
            formSubmitEndpoint: h.formSubmitEndpoint,
            formSubmitHost: h.formSubmitHost.replace("{{SHA}}", s()),
            formFields: z,
            formIdentifier: H,
            recaptchaType: _,
            recaptchaEnabled: Boolean(_),
            isReseller: U,
            category: "neutral",
            pageId: "00000000-0000-0000-0000-000000000000",
            widgetId: l,
            renderMode: a,
            dataAidPrefix: "MESSAGING"
        })) : null) : (global.React || guac.react).createElement(t.default, null), (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Block, {
            "data-aid": r.MESSAGING_FAB,
            "data-field-id": g || x ? null : "enabled",
            "data-edit-interactive": "true",
            onClick: q,
            "data-traffic2": L ? o.default.editor_preview.messaging_fab_close : o.default.editor_preview.messaging_fab_open,
            "data-tccl": p.getTCCLString({
                eid: L ? "ux2.messaging.fab.close" : "ux2.messaging.fab.open",
                type: "click"
            }),
            style: {
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                cursor: "pointer",
                width: "100%",
                height: "100%",
                borderRadius: "50%",
                backgroundColor: L ? "#555" : "action",
                boxShadow: "0px 3px 18px rgba(0, 0, 0, 0.25)",
                transform: "translateZ(0)"
            }
        }, (global.React || guac.react).createElement((global.Core || guac["@wsb/guac-widget-core"]).UX2.Element.Icon, {
            style: {
                color: L ? "#fff" : "action"
            },
            icon: L ? "close" : "chat",
            size: L ? 34 : 44
        })))
    }
    x.propTypes = {
        forceShowFlyout: (global.PropTypes || guac["prop-types"]).bool,
        businessName: (global.PropTypes || guac["prop-types"]).string,
        formEmail: (global.PropTypes || guac["prop-types"]).string,
        welcomeMessage: (global.PropTypes || guac["prop-types"]).string,
        formSuccessMessage: (global.PropTypes || guac["prop-types"]).string,
        emailOptInMessage: (global.PropTypes || guac["prop-types"]).string,
        emailOptInEnabled: (global.PropTypes || guac["prop-types"]).bool,
        section: (global.PropTypes || guac["prop-types"]).string,
        domainName: (global.PropTypes || guac["prop-types"]).string,
        config: (global.PropTypes || guac["prop-types"]).shape({
            formSubmitEndpoint: (global.PropTypes || guac["prop-types"]).string,
            formSubmitHost: (global.PropTypes || guac["prop-types"]).string
        }),
        formFields: (global.PropTypes || guac["prop-types"]).array,
        accountId: (global.PropTypes || guac["prop-types"]).string.isRequired,
        websiteId: (global.PropTypes || guac["prop-types"]).string.isRequired,
        id: (global.PropTypes || guac["prop-types"]).string,
        staticContent: (global.PropTypes || guac["prop-types"]).object.isRequired,
        locale: (global.PropTypes || guac["prop-types"]).string,
        emailConfirmationMessage: (global.PropTypes || guac["prop-types"]).string,
        recaptchaType: (global.PropTypes || guac["prop-types"]).string,
        isMobile: (global.PropTypes || guac["prop-types"]).bool,
        notificationPreference: (global.PropTypes || guac["prop-types"]).string,
        isReseller: (global.PropTypes || guac["prop-types"]).bool
    }, a.default = x, Object.defineProperty(a, "__esModule", {
        value: !0
    })
})), "undefined" != typeof window && (window.global = window);
//# sourceMappingURL=bs-Component-9afcd6f1.js.map