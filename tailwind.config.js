/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js}"],
  theme: {
    extend: {
      fontSize: {
        "5xl": ["3rem", { lineHeight: "3rem" }],
        "6xl": ["3.75rem", { lineHeight: "3.75rem" }],
        "7xl": ["4.5rem", { lineHeight: "4.5rem" }],
        "8xl": ["6rem", { lineHeight: "6rem" }],
        "9xl": ["8rem", { lineHeight: "8rem" }],
      },

    },
    // borderWidth: {
    //   default: '1px',
    //   '0': '0',
    //   '2': '2px',
    //   '3': '3px',
    //   '4': '4px', 
    //   '6': '6px',
    //   '8': '8px',
    // }
  },
  plugins: [],
  // corePlugins: {
  //   borderWidth: true,
  // },
}
