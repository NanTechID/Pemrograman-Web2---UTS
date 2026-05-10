import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [forms, daisyui],
  daisyui: {
    themes: [
      {
        modern: {
          primary: "#2563eb",
          secondary: "#0ea5e9",
          accent: "#14b8a6",
          neutral: "#f8fafc",
          "base-100": "#ffffff",
          "base-200": "#f1f5f9",
          "base-300": "#e2e8f0",
          "base-content": "#0f172a",
          info: "#0ea5e9",
          success: "#16a34a",
          warning: "#f59e0b",
          error: "#ef4444",
        },
      },
    ],
  },
};
