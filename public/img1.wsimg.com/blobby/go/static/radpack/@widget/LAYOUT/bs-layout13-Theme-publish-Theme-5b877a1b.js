define("@widget/LAYOUT/bs-layout13-Theme-publish-Theme-5b877a1b.js", ["exports", "~/c/bs-_rollupPluginBabelHelpers", "~/c/bs-index3", "~/c/bs-themeOverrides", "~/c/bs-legacyOverrides", "~/c/bs-humanisticFilled", "~/c/bs-defaultSocialIconPack", "~/c/bs-loaders", "~/c/bs-index2", "~/c/bs-index", "~/c/bs-headerTreatments"], (function(e, t, r, o, a, n, i, s, l, d, g) {
    "use strict";
    const {
        colorPackCategories: c,
        buttons: u
    } = (global.Core || guac["@wsb/guac-widget-core"]).constants, {
        LIGHT: m,
        LIGHT_ALT: h,
        LIGHT_COLORFUL: p,
        DARK: y,
        DARK_ALT: f,
        DARK_COLORFUL: b,
        COLORFUL: x,
        MVP: I
    } = (global.Core || guac["@wsb/guac-widget-core"]).constants.paintJobs, S = {
        [g.F]: "category-overlay",
        [g.a]: "category-overlay",
        [g.I]: "category-solid",
        [g.B]: "category-overlay",
        [g.L]: "category-overlay"
    }, C = {
        defaultHeaderTreatment: g.F,
        imageTreatments: S,
        heroContentItems: ["tagline", "tagline2", "cta"],
        nonHeroContentItems: ["phone"]
    };
    var H = {
        id: "layout13",
        name: "modern",
        packs: {
            color: "005",
            font: "league-spartan"
        },
        logo: {
            font: "primary"
        },
        packCategories: {
            color: c.ACCENT
        },
        headerProperties: {
            alignmentOption: "center"
        },
        headerTreatmentsConfig: C,
        showSlideshowTab: !0,
        hasNavWithBackground: !1,
        paintJobs: [m, h, p, x, b, f, y],
        defaultPaintJob: I,
        buttons: {
            primary: {
                fill: u.fills.SOLID,
                shape: u.shapes.ROUND,
                decoration: u.decorations.NONE,
                shadow: u.shadows.NONE,
                color: u.colors.PRIMARY
            },
            secondary: {
                fill: u.fills.SOLID,
                decoration: u.decorations.NONE,
                shadow: u.shadows.NONE,
                color: u.colors.PRIMARY
            },
            ...d.C
        }
    };
    const {
        SMALL_UNDERLINE: w
    } = d.s;
    class T extends r.D {
        static get displayName() {
            return "Theme13"
        }
        static getMutatorDefaultProps(e, t) {
            const r = super.getMutatorDefaultProps(e, t),
                o = d.W[t] || r.enableCircularImage;
            return "HEADER" === e ? { ...r,
                hasLogoAlign: !0,
                useSlideshow: !0,
                useMediaTypeSelector: !0,
                showOverlayOpacityControls: !0,
                hasNavBackgroundToggle: !0,
                headerTreatmentsConfig: { ...r.headerTreatmentsConfig,
                    imageTreatments: {
                        [g.F]: "category-overlay",
                        [g.a]: "category-overlay",
                        [g.I]: "category-solid",
                        [g.B]: "category-overlay",
                        [g.L]: "category-overlay"
                    },
                    heroContentItems: ["tagline", "tagline2", "cta"],
                    nonHeroContentItems: ["phone"]
                }
            } : { ...r,
                enableCircularImage: o
            }
        }
        constructor() {
            super(), t._(this, "sharedInputStyles", {
                style: {
                    borderColor: "input",
                    borderRadius: "medium",
                    borderStyle: "solid",
                    borderWidth: "xsmall"
                }
            }), this.mappedValues = { ...this.mappedValues,
                backgroundColorNavSolid() {
                    return r.g(this, "background").setAlpha(25)
                },
                typographyOverrides: {
                    LogoAlpha: {
                        style: {
                            font: "primary",
                            color: "highContrast",
                            fontSize: "large",
                            fontWeight: "normal",
                            letterSpacing: "normal",
                            textTransform: "none"
                        }
                    },
                    HeadingBeta: {
                        style: {
                            font: "primary",
                            color: "highlight",
                            fontSize: "xxlarge",
                            fontWeight: "normal",
                            letterSpacing: "normal",
                            textTransform: "none"
                        }
                    },
                    HeadingGamma: {
                        style: {
                            font: "alternate",
                            color: "highlight",
                            fontSize: "xlarge",
                            fontWeight: "normal",
                            letterSpacing: "normal",
                            textTransform: "none"
                        }
                    },
                    NavAlpha: {
                        style: {
                            font: "alternate",
                            color: "highContrast",
                            fontSize: "small",
                            fontWeight: "normal",
                            textTransform: "uppercase",
                            letterSpacing: "0.071em",
                            ":hover": {
                                color: "highContrast"
                            },
                            ":active": {
                                color: "highContrast"
                            }
                        },
                        active: {
                            style: {
                                color: "highContrast",
                                ":hover": {
                                    color: "highContrast"
                                }
                            }
                        }
                    },
                    SubNavAlpha: {
                        style: {
                            font: "alternate",
                            color: "section",
                            fontSize: "medium",
                            fontWeight: "normal",
                            letterSpacing: "normal",
                            textTransform: "none",
                            textDecoration: "none",
                            ":hover": {
                                color: "section"
                            },
                            ":active": {
                                color: "section"
                            }
                        },
                        active: {
                            style: {
                                fontWeight: "bold",
                                color: "section",
                                ":hover": {
                                    color: "section"
                                }
                            }
                        }
                    },
                    ButtonAlpha: e => {
                        const {
                            size: t = "default"
                        } = e;
                        return {
                            style: {
                                font: "alternate",
                                fontWeight: "bold",
                                textTransform: "uppercase",
                                letterSpacing: "0.071em",
                                ...{
                                    small: {
                                        fontSize: "xsmall"
                                    },
                                    default: {
                                        fontSize: "small"
                                    },
                                    large: {
                                        fontSize: "medium"
                                    }
                                }[t]
                            }
                        }
                    },
                    InputAlpha: e => (global._ || guac.lodash).merge(r.m.call(this, "BodyAlpha", e), {
                        style: {
                            color: "input",
                            "@xs-only": {
                                fontSize: "medium"
                            }
                        }
                    })
                }
            }
        }
        Heading(e) {
            const {
                tag: t
            } = e, {
                widgetType: r,
                widgetPreset: o
            } = this.base;
            return super.Heading(this.merge({
                style: a.g(t, r, o)
            }, e))
        }
        Intro(e) {
            return super.Intro(this.merge({
                alignment: "center"
            }, e))
        }
        Phone(e) {
            return super.Phone(this.merge({
                style: {
                    paddingBottom: "xlarge",
                    display: "inline-block",
                    paddingTop: 0,
                    "@md": {
                        paddingBottom: "xxlarge",
                        maxWidth: "50%"
                    }
                }
            }, e))
        }
        ContentCard(e) {
            const t = "about1" === this.base.widgetPreset ? {
                style: {
                    alignItems: "center"
                }
            } : {};
            return super.ContentCard(this.merge(t, e))
        }
        Hero(e) {
            return super.Hero(this.merge({
                style: { ...l.a("xsmall"),
                    position: "relative",
                    marginVertical: 0,
                    paddingVertical: "medium",
                    width: "100%",
                    display: "flex",
                    justifyContent: "center",
                    flexDirection: "column",
                    "@md": {
                        flexGrow: 1,
                        flexShrink: 0,
                        flexBasis: "auto",
                        paddingVertical: "xlarge"
                    }
                }
            }, e))
        }
        Tagline(e) {
            return super.Tagline(this.merge({
                style: {
                    maxWidth: "100%",
                    wordWrap: "break-word",
                    overflowWrap: "break-word",
                    "@xs-only": {
                        margin: "0 auto"
                    }
                }
            }, e))
        }
        HeroText(e) {
            return super.SubTagline(this.merge({
                style: {
                    lineHeight: "1.5",
                    maxWidth: "100%"
                }
            }, e))
        }
        Icon(e) {
            return super.Icon(this.merge({
                iconPack: { ...n.f,
                    ...i.s
                }
            }, e))
        }
        Loader(e) {
            return s.a.apply(this, [e])
        }
        SectionHeading(e) {
            const t = this.base,
                r = this.merge({}, o.s(t), o.b(t), o.c(t), o.a(t));
            return super.SectionHeading(this.merge({
                style: {
                    textAlign: "center",
                    marginLeft: "auto",
                    "@md": {
                        textAlign: "center",
                        marginLeft: "auto"
                    }
                },
                sectionHeadingHR: w,
                featured: !1
            }, r, e))
        }
        DividerHR(e) {
            const {
                category: t
            } = e;
            return super.HR(this.merge({
                style: {
                    borderColor: "neutral" === t ? "rgba(0, 0, 0, 0.3)" : "rgba(255, 255, 255, 0.3)"
                }
            }, e))
        }
        Pipe(e) {
            return super.Pipe(this.merge({
                style: {
                    height: "1em"
                }
            }, e))
        }
        HeaderMediaBackground(e) {
            return super.BackgroundResponsive(this.merge({
                style: {
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center",
                    flexDirection: "column"
                }
            }, e))
        }
        HeaderMediaFillBackground(e) {
            return this.HeaderMediaBackground(this.merge({
                style: {
                    minHeight: 300,
                    justifyContent: "space-between",
                    "@md": {
                        minHeight: "85vh"
                    }
                }
            }, e))
        }
        HeaderMediaOrigBlurBackground(e) {
            return super.Background(this.merge({
                style: {
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center",
                    flexDirection: "column"
                }
            }, e))
        }
        HeaderMediaImage(e) {
            return super.Image(this.merge({
                style: {
                    borderStyle: "solid",
                    borderWidth: "large",
                    borderColor: "white"
                }
            }, {
                mobileGutterWidth: 18
            }, e))
        }
        HeaderMediaInsetVideo(e) {
            return super.Video(this.merge({
                style: {
                    borderStyle: "solid",
                    borderWidth: "large",
                    borderColor: "white"
                }
            }, e))
        }
        HeaderMediaBlurVideo(e) {
            return this.HeaderMediaInsetVideo(e)
        }
        PromoBanner(e) {
            return super.PromoBanner(this.merge({
                style: {
                    position: "relative",
                    zIndex: 1
                }
            }, e))
        }
        Input(e) {
            return super.Input(this.merge({ ...this.sharedInputStyles
            }, {
                style: {
                    paddingVertical: "small",
                    paddingHorizontal: "small"
                }
            }, e))
        }
        InputFloatLabelLabel(e) {
            return super.InputFloatLabelLabel(this.merge({
                style: {
                    left: "16px",
                    top: "33%"
                }
            }, e))
        }
        InputTextArea(e) {
            return super.InputTextArea(this.merge({
                rows: 6
            }, e))
        }
        InputSelect(e) {
            return super.InputSelect(this.merge({ ...this.sharedInputStyles
            }, e))
        }
        InputSelectElement(e) {
            return super.InputSelectElement(this.merge({
                style: {
                    paddingVertical: "small",
                    paddingHorizontal: "small"
                }
            }, e))
        }
        MediaObjectBackground(e) {
            return super.MediaObjectBackground(this.merge({
                style: {
                    borderRadius: "medium"
                }
            }, e))
        }
        HeadingMajor(e) {
            return super.HeadingMajor(this.merge({
                featured: !0
            }, e))
        }
        PriceMajor(e) {
            return super.PriceMajor(this.merge({
                typography: "HeadingDelta"
            }, e))
        }
        SlideshowArrows(e) {
            return super.SlideshowArrows(this.merge({
                style: {
                    "@sm": {
                        paddingHorizontal: "medium",
                        marginHorizontal: "medium"
                    }
                }
            }, e))
        }
    }
    t._(T, "config", H), e.default = T, Object.defineProperty(e, "__esModule", {
        value: !0
    })
})), "undefined" != typeof window && (window.global = window);
//# sourceMappingURL=bs-layout13-Theme-publish-Theme-5b877a1b.js.map