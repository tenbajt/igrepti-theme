const plugin = require('tailwindcss/plugin');
const colors = require('tailwindcss/colors')

module.exports = {
    mode: 'jit',
    purge: {
        content: [
            '../index.php',
            '../footer.php',
            '../header.php',
            '../woocommerce/**/*.php',
            '../page-templates/**/*.php',
            '../partial-templates/**/*.php',
        ],
        safelist: [
            'woocommerce-notices-wrapper',
        ],
    },
    theme: {
        colors: {
            red: colors.red,
            gray: colors.coolGray,
            blue: colors.blue,
            green: colors.green,
            yellow: colors.yellow,
            black: {
                high: 'rgba(0, 0, 0, 0.87)',
                medium: 'rgba(0, 0, 0, 0.60)',
                DEFAULT: '#000000',
                disabled: 'rgba(0, 0, 0, 0.38)',
            },
            white: {
                high: 'rgba(255, 255, 255, 0.87)',
                medium: 'rgba(255, 255, 255, 0.60)',
                DEFAULT: '#FFFFFF',
                disabled: 'rgba(255, 255, 255, 0.30)',
            },
            current: 'currentColor',
            transparent: 'transparent',
        },
        extend: {
            aspectRatio: {
                'a4': '1.4142',
            },
            fontFamily: {
                'inter': 'Inter, sans-serif',
                'roboto': 'Roboto, sans-serif',
            },
            minWidth: {
                'screen-lg': '1024px',
                'screen-xl': '1280px',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
        plugin(({addBase, config}) => {
            const base = {
                'body': {
                    fontFamily: 'Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                },
                'a, button': {
                    transition: 'background-color 150ms, border-color 150ms, color 150ms',
                },
                'ul': {
                    margin: '1em 0',
                    paddingLeft: '40px',
                    listStyleType: 'disc',
                },
                'select, textarea, [type="tel"], [type="text"], [type="email"], [type="search"], [type="number"], [type="checkbox"], [type="password"]': {
                    boxShadow: config('theme.boxShadow.sm'),
                    borderColor: config('theme.colors.gray.300'),
                    borderRadius: config('theme.borderRadius.sm'),
                    backgroundColor: config('theme.colors.gray.50'),
                },
                'select:focus, textarea:focus, [type="tel"]:focus, [type="text"]:focus, [type="email"]:focus, [type="search"]:focus, [type="number"]:focus, [type="checkbox"]:focus, [type="password"]:focus': {
                    '--tw-ring-color': config('theme.colors.green.600'),
                    borderColor: 'var(--tw-ring-color)',
                },
                'textarea': {
                    resize: 'none',
                },
                '[type="number"]:out-of-range': {
                    borderColor: config('theme.colors.red.300'),
                    backgroundColor: config('theme.colors.red.50'),
                },
                '[type="number"]:focus:out-of-range': {
                    '--tw-ring-color': config('theme.colors.red.600'),
                    borderColor: 'var(--tw-ring-color)',
                },
                '[type="radio"]': {
                    boxShadow: config('theme.boxShadow.sm'),
                    borderColor: config('theme.colors.gray.300'),
                    backgroundColor: config('theme.colors.gray.50'),
                },
                '[type="radio"], [type="checkbox"]': {
                    color: config('theme.colors.green.600'),
                    cursor: 'pointer',
                },
            };
            addBase(base);
        }),
        plugin(({addComponents, config, theme}) => {
            const components = {
                '.btn': {
                    color: 'white',
                    border: '1px solid transparent',
                    display: 'inline-grid',
                    padding: '0.75rem 1.25rem',
                    fontSize: '16px',
                    boxShadow: config('theme.boxShadow.sm'),
                    lineHeight: '1.5',
                    fontWeight: '500',
                    userSelect: 'none',
                    whiteSpace: 'nowrap',
                    alignItems: 'center',
                    borderRadius: config('theme.borderRadius.sm'),
                    justifyItems: 'center',
                    gridAutoFlow: 'column',
                    backgroundColor: config('theme.colors.green.600'),
                },
                '.btn:hover': {
                    backgroundColor: config('theme.colors.green.700'),
                },
                '.hamburger-spin': {
                    backgroundColor: 'transparent',
                    height         : '2rem',
                    position       : 'relative',
                    touchAction    : 'manipulation',
                    width          : '2rem',

                    '@media (min-width: 1024px)': {
                        display: 'none',
                    }
                },
                '.hamburger-spin > div, .hamburger-spin > div:before, .hamburger-spin > div:after': {
                    backgroundColor: 'black',
                    display        : 'block',
                    height         : '.125rem',
                    position       : 'absolute',
                    width          : '1.5rem',
                },
                '.hamburger-spin > div': {
                    left      : '.25rem',
                    marginTop : '-1px',
                    top       : '50%',
                    transition: 'transform 300ms',
                },
                '.hamburger-spin[data-state="toggled"] > div': {
                    transform: 'rotate(135deg)',
                },
                '.hamburger-spin > div:before, .hamburger-spin > div:after': {
                    content: '""',
                },
                '.hamburger-spin > div:before': {
                    top       : '-.375rem',
                    transition: 'top 150ms 150ms, transform 150ms',
                },
                '.hamburger-spin[data-state="toggled"] > div:before': {
                    top       : '0',
                    transform : 'rotate(90deg)',
                    transition: 'top 150ms, transform 150ms 150ms',
                },
                '.hamburger-spin > div:after': {
                    bottom    : '-.375rem',
                    transition: 'transform 150ms 150ms',
                },
                '.hamburger-spin[data-state="toggled"] > div:after': {
                    transform : 'translate(0, -.375rem)',
                    transition: 'transform 150ms',
                },
                '.woocommerce-notices-wrapper': {
                    display: 'none',
                },
            };
            addComponents(components);
        }),
        plugin(({addVariant, e}) => {
            addVariant('toggled', ({modifySelectors,separator}) => {
                modifySelectors(({className}) => {
                    return `.${e(`toggled${separator}${className}`)}[data-state="toggled"]`
                });
            });
            addVariant('selected', ({modifySelectors, separator}) => {
                modifySelectors(({className}) => {
                    return `.${e(`selected${separator}${className}`)}[data-state="selected"]`
                });
            });
            addVariant('group-selected', ({modifySelectors, separator}) => {
                modifySelectors(({className}) => {
                    return `.group[data-state="selected"] .${e(`group-selected${separator}${className}`)}`
                });
            });
        }),
    ]
}
