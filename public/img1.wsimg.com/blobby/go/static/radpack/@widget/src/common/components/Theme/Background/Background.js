import PropTypes from 'prop-types';
import {
    uniqueId,
    isEqual,
    isFunction
} from 'lodash';
import {
    utils,
    UX2
} from '@wsb/guac-widget-core';
import {
    CDN_REGEX,
    addImageApiArgs,
    generateBackgroundUrl
} from '../../../utils/image';

const {
    Image
} = utils;

export class Background extends UX2.utils.createElement('Background') {
    static propTypes = {
        className: PropTypes.string,
        children: PropTypes.any,
        backgroundImage: PropTypes.string,
        backgroundSize: PropTypes.string,
        backgroundPosition: PropTypes.string,
        style: PropTypes.object,
        treatmentData: PropTypes.object,
        imageData: PropTypes.object
    };

    static defaultProps = {
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        treatmentData: {}
    };

    constructor() {
        super(...arguments);

        const {
            backgroundImage,
            treatmentData,
            imageData = {}
        } = this.props;
        const {
            widgetType,
            widgetPreset
        } = this;
        this.state = {
            id: uniqueId('guacBg'),
            backgroundImage: backgroundImage || generateBackgroundUrl(imageData),
            isResponsive: CDN_REGEX.test(backgroundImage || generateBackgroundUrl(imageData)),
            defaultFilter:
                !imageData.filter &&
                this.theme &&
                isFunction(this.theme.constructor.getDefaultBackgroundFilter) &&
                this.theme.constructor.getDefaultBackgroundFilter(widgetType, widgetPreset),
            widgetType,
            widgetPreset,
            ...treatmentData
        };
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        const {
            backgroundImage,
            treatmentData,
            defaultFilter
        } = prevState;
        const {
            treatmentData: nextTreatmentData,
            imageData = {}
        } = nextProps;

        const nextBackgroundImage = nextProps.backgroundImage ?
            addImageApiArgs(
                nextProps.backgroundImage,
                utils.generateImageFilterUrlParam(imageData.filter || defaultFilter)
            ) :
            imageData &&
            generateBackgroundUrl({
                filter: defaultFilter,
                ...imageData,
                ...(nextProps.backgroundImage &&
                    nextProps.backgroundImage.indexOf('fx-bl=s') > -1 && {
                        image: nextProps.backgroundImage
                    })
            });

        const state = {
            ...Background.backgroundImageUpdate(backgroundImage, nextBackgroundImage),
            ...(nextTreatmentData && !isEqual(treatmentData, nextTreatmentData) && nextTreatmentData)
        };

        return Object.keys(state).length > 0 ? state : null;
    }

    static backgroundImageUpdate(backgroundImage, nextBackgroundImage) {
        return backgroundImage !== nextBackgroundImage ?
            {
                responsiveImage: null,
                backgroundImage: nextBackgroundImage,
                isResponsive: CDN_REGEX.test(nextBackgroundImage)
            } :
            {};
    }

    componentDidMount() {
        this.mounted = true;
        if (this.state.backgroundImage && this.state.isResponsive) {
            this._instance = new Image(
                this.state.backgroundImage,
                // use this instead of react-dom.findDOMNode to avoid
                // multi-react-instance test failures in modules that depend on widget-core
                document.getElementById(this.state.id), {},
                this.onRender.bind(this)
            );
        }
    }

    componentDidUpdate() {
        if (this.state.backgroundImage && !this.state.responsiveImage) {
            // if background set, and none loaded, trigger remount
            this.componentWillUnmount();
            this.componentDidMount();
        }
    }

    componentWillUnmount() {
        this.mounted = false;
        if (this._instance) this._instance.unmount();
    }

    onRender(imageUrl) {
        if (this.mounted) {
            const {
                treatmentData
            } = this.props;

            const state = {
                responsiveImage: imageUrl,
                ...treatmentData
            };

            this.setState(state);
        }
    }
}

export class BackgroundResponsive extends UX2.utils.createElement('Background', 'Responsive') {
    constructor(props) {
        super(props);
        this.id = uniqueId('bg-');
    }

    static propTypes = {
        className: PropTypes.string,
        backgroundSize: PropTypes.string,
        backgroundPosition: PropTypes.string,
        style: PropTypes.object,
        imageData: PropTypes.object,
        mobileWidthMultiplier: PropTypes.number,
        desktopWidthMultiplier: PropTypes.number,
        blur: PropTypes.bool
    };

    static defaultProps = {
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        mobileWidthMultiplier: 1,
        desktopWidthMultiplier: 1
    };
}

export class BackgroundHalf extends UX2.utils.createElement('Background', 'Half') {
    constructor(props) {
        super(props);
        this.id = uniqueId('bg-');
    }

    static propTypes = {
        className: PropTypes.string,
        backgroundImage: PropTypes.string,
        backgroundSize: PropTypes.string,
        backgroundPosition: PropTypes.string,
        style: PropTypes.object,
        imageData: PropTypes.object
    };

    static defaultProps = {
        backgroundSize: 'cover',
        backgroundPosition: 'center'
    };
}