import {
    constants
} from '@wsb/guac-widget-core';
import {
    FILL,
    FIT,
    INSET,
    BLUR,
    LEGACY_BLUR
} from '../../common/constants/headerTreatments';
import {
    COMMON_BUTTON_CONFIG
} from '../../common/constants';

const {
    colorPackCategories,
    buttons
} = constants;
const {
    LIGHT,
    LIGHT_ALT,
    LIGHT_COLORFUL,
    DARK,
    DARK_ALT,
    DARK_COLORFUL,
    COLORFUL,
    MVP
} =
constants.paintJobs;

const id = 'layout13';
const imageTreatments = {
    [FILL]: 'category-overlay',
    [FIT]: 'category-overlay',
    [INSET]: 'category-solid',
    [BLUR]: 'category-overlay',
    [LEGACY_BLUR]: 'category-overlay'
};

const headerTreatmentsConfig = {
    defaultHeaderTreatment: FILL,
    imageTreatments,
    heroContentItems: ['tagline', 'tagline2', 'cta'],
    nonHeroContentItems: ['phone']
};

export default {
    id,
    name: 'modern',
    packs: {
        color: '005',
        font: 'league-spartan'
    },
    logo: {
        font: 'primary'
    },
    packCategories: {
        color: colorPackCategories.ACCENT
    },
    headerProperties: {
        alignmentOption: 'center'
    },
    headerTreatmentsConfig,
    showSlideshowTab: true,
    hasNavWithBackground: false,
    paintJobs: [LIGHT, LIGHT_ALT, LIGHT_COLORFUL, COLORFUL, DARK_COLORFUL, DARK_ALT, DARK],
    defaultPaintJob: MVP,
    buttons: {
        primary: {
            fill: buttons.fills.SOLID,
            shape: buttons.shapes.ROUND,
            decoration: buttons.decorations.NONE,
            shadow: buttons.shadows.NONE,
            color: buttons.colors.PRIMARY
        },
        secondary: {
            fill: buttons.fills.SOLID,
            decoration: buttons.decorations.NONE,
            shadow: buttons.shadows.NONE,
            color: buttons.colors.PRIMARY
        },
        ...COMMON_BUTTON_CONFIG
    }
};