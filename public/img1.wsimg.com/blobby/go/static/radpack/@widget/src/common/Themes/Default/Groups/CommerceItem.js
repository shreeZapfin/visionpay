export function CommerceItem(props) {
    return this.Block(
        this.merge({
                style: {
                    display: 'flex',
                    flexDirection: 'column',
                    height: '100%'
                }
            },
            props
        )
    );
}

export function CommerceItemHeading({
    align,
    ...props
}) {
    return this.Heading(
        this.merge({
                typography: 'BodyAlpha',
                featured: true,
                style: {
                    marginBottom: 'xsmall',
                    textAlign: align
                }
            },
            props
        )
    );
}

export function CommerceItemIcon(props) {
    return this.Icon(
        this.merge({
                style: {
                    display: 'inline-block',
                    marginRight: 'xxsmall',
                    marginLeft: '-xxsmall'
                }
            },
            props
        )
    );
}

export function CommerceItemPrice(props) {
    return this.Price(
        this.merge({
                typography: 'DetailsAlpha'
            },
            props
        )
    );
}

export function CommerceItemWrapper(props) {
    return this.Wrapper(
        this.merge({
                style: {
                    position: 'absolute',
                    top: '0',
                    left: '0',
                    right: '0',
                    bottom: '0'
                }
            },
            props
        )
    );
}

export function CommerceItemLabel({
    size = {
        xs: 'large'
    },
    ...props
}) {
    const styles = {};
    const defaultStyles = {
        paddingHorizontal: 'medium',
        paddingVertical: 'small',
        top: '10px',
        right: '10px'
    };

    for (const key of Object.keys(size)) {
        styles[key] =
            size[key] === 'large' ?
            {
                ...defaultStyles
            } :
            {
                paddingHorizontal: 'small',
                paddingVertical: 'xxsmall',
                top: '5px',
                right: '5px'
            };
    }

    const style = {
        'position': 'absolute',
        'display': 'block',
        'backgroundColor': 'section',
        ...defaultStyles,
        ...styles.xs,
        '@sm': {
            ...styles.sm
        },
        '@md': {
            ...styles.md
        },
        '@lg': {
            ...styles.lg
        },
        '@xl': {
            ...styles.xl
        }
    };

    return this.DetailsMinor(
        this.merge({
                style: style,
                category: 'primary'
            },
            props
        )
    );
}

export function CommerceItemButton(props) {
    return this.Button(
        this.merge({
                size: 'small'
            },
            props
        )
    );
}