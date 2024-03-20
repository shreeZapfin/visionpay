import React from 'react';
import PropTypes from 'prop-types';
import {
    UX2
} from '@wsb/guac-widget-core';
import dataAids from '../../constants/dataAids';
import * as keys from '../../constants/widget/keys';

function MessageBubble({
    text
}) {
    return ( <
        UX2.Element.Block category = 'neutral'
        section = 'overlay'
        style = {
            {
                backgroundColor: 'neutral',
                margin: '-medium medium medium medium',
                borderRadius: '5px',
                position: 'relative'
            }
        } >
        <
        UX2.Element.Text style = {
            {
                padding: '12px 15px',
                borderRadius: '5px',
                backgroundColor: 'primaryOverlay',
                fontSize: '16px',
                color: 'neutral'
            }
        } >
        {
            text
        } <
        /UX2.Element.Text> <
        UX2.Element.Element tag = 'svg'
        width = '33px'
        height = '16px'
        viewBox = '0 0 33 16'
        style = {
            {
                fill: 'primaryOverlay',
                position: 'absolute',
                top: '100%',
                left: '3px',
                marginTop: '-1px'
            }
        }
        xmlns = 'http://www.w3.org/2000/svg' >
        { /* eslint-disable-next-line max-len */ } <
        path d = 'M0.342304 14.5C7.35025 6.3293 3.35025 0.829295 0 0.0.0 0.0 5.4 2.1 32.3502 0.329295C32.3503 3.8293 -3.13481 20.7261 0.342304 14.5Z' / >
        <
        /UX2.Element.Element> <
        /UX2.Element.Block>
    );
}

MessageBubble.propTypes = {
    text: PropTypes.string.isRequired
};

function MessageFlyout({
    title,
    message,
    children,
    onClose
}) {
    return ( <
        UX2.Element.Block data - aid = {
            dataAids.MESSAGING_MESSAGE_FLYOUT
        }
        style = {
            {
                ['-webkit-overflow-scrolling']: 'touch',
                overflowX: 'hidden',
                    overflowY: 'auto',
                    boxShadow: '0px 3px 18px rgba(0, 0, 0, 0.25)',
                    backgroundColor: 'neutral',
                    borderRadius: '5px',
                    borderWidth: 'xsmall',
                    borderStyle: 'solid',
                    borderColor: '#fff',
                    // desktop/mobile positioning
                    width: '382px',
                    marginBottom: 'small',
                    position: 'absolute',
                    maxHeight: 'calc(100vh - 105px)',
                    right: '-1px',
                    bottom: '100%', ['@xs-only']: {
                        maxHeight: '100vh',
                        height: '100vh',
                        zIndex: 'inherit',
                        position: 'fixed',
                        left: '0',
                        top: '0',
                        bottom: '89px',
                        width: '100%'
                    }
            }
        } >
        <
        UX2.Element.Block data - field - id = {
            keys.SEND_MESSAGE_TO
        } >
        <
        UX2.Element.Icon onClick = {
            onClose
        }
        icon = 'close'
        size = {
            22
        }
        style = {
            {
                color: '#fff',
                position: 'absolute',
                top: '18px',
                right: '14px',
                cursor: 'pointer',
                ['@sm']: {
                    display: 'none'
                }
            }
        }
        /> <
        UX2.Element.Heading style = {
            {
                color: 'action',
                fontSize: 'large',
                backgroundColor: 'action',
                paddingTop: 'small',
                paddingBottom: message ? 'xlarge' : 'small',
                paddingLeft: 'medium',
                paddingRight: 'medium',
                margin: message ? '0' : '0 0 medium 0',
                textAlign: 'left',
                ['@md']: {
                    textAlign: 'left'
                }
            }
        } >
        {
            title
        } <
        /UX2.Element.Heading> {
            message ? < MessageBubble text = {
                message
            }
            /> : null } <
            UX2.Element.Block
            style = {
                    {
                        overflow: 'hidden',
                        padding: '0 medium'
                    }
                } >
                {
                    children
                } <
                /UX2.Element.Block> <
                /UX2.Element.Block> <
                /UX2.Element.Block>
        );
    }

    MessageFlyout.propTypes = {
        title: PropTypes.string.isRequired,
        message: PropTypes.string.isRequired,
        children: PropTypes.node.isRequired,
        onClose: PropTypes.func.isRequired
    };

    export default MessageFlyout;