import {
    constants
} from '@wsb/guac-widget-core';
const {
    Z_INDEX_NAV_DRAWER
} = constants.layers;

export function NavigationDrawer({
    category = 'accent',
    left = true,
    ...props
}) {
    const alignStyles = {
        left: left ? 0 : 'unset',
        right: left ? 'unset' : 0
    };

    return this.merge({
            category,
            section: 'default',
            style: {
                backgroundColor: 'sectionOverlay',
                position: 'fixed',
                top: 0,
                width: '100%',
                height: '100%',
                maxWidth: 0,
                overflowY: 'auto',
                zIndex: Z_INDEX_NAV_DRAWER,
                paddingTop: 'xxlarge',
                WebkitOverflowScrolling: 'touch',
                transition: 'max-width .3s ease-in-out',
                ...alignStyles
            },
            role: 'navigation'
        },
        props
    );
}

export function NavigationDrawerList(props) {
    return this.List(
        this.merge({
                role: 'menu'
            },
            props
        )
    );
}

export function NavigationDrawerListItem(props) {
    return this.ListItem(
        this.merge({
                style: {
                    'display': 'block',
                    'marginBottom': '0',
                    'borderColor': 'uLowContrastOverlay',
                    'borderBottomWidth': 1,
                    'borderBottomStyle': 'solid',
                    ':last-child': {
                        borderBottom: 'none'
                    }
                },
                role: 'menuitem'
            },
            props
        )
    );
}

export function NavigationDrawerLink(props) {
    return this.Link(
        this.merge({
                typography: 'NavBeta',
                style: {
                    paddingVertical: 'small',
                    paddingHorizontal: 'medium',
                    display: 'flex',
                    alignItems: 'center',
                    minWidth: 200,
                    justifyContent: 'space-between',
                    ['@md']: {
                        minWidth: 300
                    }
                }
            },
            props
        )
    );
}

export function NavigationDrawerLinkActive(props) {
    return this.NavigationDrawerLink(
        this.merge({
                active: true
            },
            props
        )
    );
}

export function NavigationDrawerSubLink(props) {
    return this.NavigationDrawerLink(
        this.merge({
                typography: 'SubNavBeta',
                style: {
                    display: 'block',
                    paddingVertical: 'xsmall',
                    paddingLeft: 'xlarge',
                    paddingRight: 'medium'
                }
            },
            props
        )
    );
}

export function NavigationDrawerSubLinkActive(props) {
    return this.NavigationDrawerSubLink(
        this.merge({
                active: true
            },
            props
        )
    );
}

export function NavigationDrawerInputSearch(props) {
    return this.Input(
        this.merge({
                style: {
                    backgroundColor: 'searchMobileDark',
                    borderWidth: 'none',
                    borderRadius: 'none',
                    paddingVertical: 'small',
                    paddingHorizontal: 'xlarge'
                },
                role: 'searchbox'
            },
            props
        )
    );
}