<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="shortcut icon" href="/favicon.ico" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.-left-20{left:-5rem}.top-0{top:0px}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-mx-3{margin-left:-0.75rem;margin-right:-0.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-full{width:100%}.w-\[calc\(100\%\+8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.max-w-\[877px\]{max-width:877px}.max-w-2xl{max-width:42rem}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-sm{border-radius:0.125rem}.bg-\[\#FF2D20\]\/10{background-color:rgb(255 45 32 / 0.1)}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gradient-to-b{background-image:linear-gradient(to bottom, var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from:transparent var(--tw-gradient-from-position);--tw-gradient-to:rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to:rgb(255 255 255 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to:#fff var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#FF2D20}.object-cover{object-fit:cover}.object-top{object-position:top}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.pt-3{padding-top:0.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:0.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-semibold{font-weight:600}.text-black{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\]{--tw-shadow:0px 14px 34px 0px rgba(0,0,0,0.08);--tw-shadow-colored:0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.ring-transparent{--tw-ring-color:transparent}.ring-white\/\[0\.05\]{--tw-ring-color:rgb(255 255 255 / 0.05)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-black:hover{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.hover\:text-black\/70:hover{color:rgb(0 0 0 / 0.7)}.hover\:ring-black\/20:hover{--tw-ring-color:rgb(0 0 0 / 0.2)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}@media (min-width: 640px){.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0px}.lg\:text-\[\#FF2D20\]{--tw-text-opacity:1;color:rgb(255 45 32 / var(--tw-text-opacity))}}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity))}.dark\:bg-zinc-900{--tw-bg-opacity:1;background-color:rgb(24 24 27 / var(--tw-bg-opacity))}.dark\:via-zinc-900{--tw-gradient-to:rgb(24 24 27 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to:#18181b var(--tw-gradient-to-position)}.dark\:text-white\/50{color:rgb(255 255 255 / 0.5)}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-white\/70{color:rgb(255 255 255 / 0.7)}.dark\:ring-zinc-800{--tw-ring-opacity:1;--tw-ring-color:rgb(39 39 42 / var(--tw-ring-opacity))}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:hover\:text-white\/70:hover{color:rgb(255 255 255 / 0.7)}.dark\:hover\:text-white\/80:hover{color:rgb(255 255 255 / 0.8)}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity:1;--tw-ring-color:rgb(63 63 70 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 255 255 / var(--tw-ring-opacity))}}
            </style>
        @endif
    </head>
    <body>
    <div class="bg-white">
        <div class="container mx-auto lg:px-10">
            <header class="py-10">
                <a href="/" class="flex lg:justify-start lg:col-start-2 items-center gap-2">
                    <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.0126 8.61322C25.6541 8.49116 24.7218 7.86098 24.1278 6.9441C23.7186 6.31108 23.5139 5.77173 23.4287 4.96272L21.263 5.12452C21.4051 6.24295 21.2573 7.33867 20.8196 8.21865C20.345 9.16676 19.5463 9.85939 18.4152 10.0723C18.3242 10.0893 18.2503 10.1007 18.1935 10.1092C16.9969 10.2596 15.8914 9.87358 15.0188 9.12702C14.3282 8.53658 13.7853 7.71905 13.4642 6.77378C10.9745 7.45505 9.27489 8.3691 7.4872 9.66352C3.60485 12.4738 1.064 16.8112 1.55 22.5623C2.57601 30.5787 9.56194 33.4372 19.9755 33.1562C26.2679 32.3557 32.694 29.3524 35.1382 26.9736C40.4928 21.7704 39.7311 16.5756 35.8686 11.168C34.4504 9.18379 32.8048 8.00575 30.4629 6.75107C30.1673 7.1939 29.8036 7.58847 29.3886 7.90072C28.7122 8.40884 27.905 8.6927 27.0126 8.61322Z"
                              fill="#00EB00"/>
                        <path d="M26.9898 8.63307C25.6313 8.51101 24.6991 7.88083 24.1051 6.96394C23.6958 6.32809 23.4912 5.79158 23.4059 4.98257L21.2402 5.14437C21.3823 6.2628 21.2345 7.35852 20.7968 8.23566C20.3222 9.18661 19.5236 9.8764 18.3924 10.0921C18.3015 10.1092 18.2276 10.1205 18.1707 10.129C16.9742 10.2795 15.8686 9.89059 14.9961 9.14686C14.3054 8.55643 13.7626 7.73889 13.4414 6.79363C10.9517 7.4749 9.25214 8.38611 7.46444 9.68337C3.5821 12.4936 1.04124 16.8311 1.52724 22.5793C2.55325 30.5985 9.53919 33.457 19.9527 33.176C26.2452 32.3755 32.6712 29.3694 35.1155 26.9934C40.47 21.7902 39.7083 16.5955 35.8459 11.1879C34.4277 9.20364 32.7821 8.02276 30.4402 6.77092C30.1446 7.21375 29.7808 7.60832 29.3658 7.91773C28.6894 8.42585 27.8823 8.70971 26.9898 8.63307ZM23.3292 3.71937C23.5423 1.25826 25.2362 -0.192288 27.6606 0.0206105C28.8457 0.122802 30.0082 0.664984 30.7073 1.59322C31.2502 2.31708 31.4434 3.25099 31.361 4.19626C31.3241 4.59083 31.2416 4.98824 31.1166 5.3743L31.29 5.43391C41.064 10.5548 43.3917 22.199 35.9596 28.1488C28.9594 33.2811 21.1294 35.4697 13.0066 34.1099C5.32148 32.8269 -0.166661 29.1026 0.00386614 20.5043C0.145972 13.3339 5.84443 7.90921 13.1771 5.51623C13.1203 4.13381 13.9558 2.95861 15.1183 2.25463C15.5872 1.96792 16.1073 1.7607 16.6388 1.64999C17.1788 1.53645 17.7387 1.51942 18.2816 1.61877C19.3871 1.82315 20.3705 2.49023 20.8935 3.76763C21.6523 3.63705 23.3292 3.71937 23.3292 3.71937ZM16.7354 2.94726C12.8702 3.79885 14.476 9.37963 18.0513 8.92545C21.3994 8.27256 21.2459 1.8856 16.7354 2.94726ZM25.0174 6.57789C27.8567 10.0297 31.8413 4.63058 29.7012 2.17798C29.0759 1.34342 27.5611 0.943171 26.5777 1.18446C24.2358 1.81464 24.0141 5.07908 25.0174 6.57789Z"
                              fill="#293B29"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M17.7074 4.0316C18.4521 3.93508 19.1342 4.46307 19.228 5.2068C19.3246 5.95336 18.5317 6.86173 17.787 6.9554C17.0424 7.04908 16.3915 6.51825 16.2977 5.77453C16.204 5.0308 16.9628 4.12527 17.7074 4.0316Z"
                              fill="#293B29"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M27.6293 2.65489C29.7637 2.38522 29.3772 5.53896 27.4446 5.59857C27.0381 5.60992 26.4555 5.33174 26.2566 4.31834C26.0832 3.43552 26.8875 2.74857 27.6293 2.65489Z"
                              fill="#293B29"/>
                        <path d="M24.9463 32.6878C25.1964 33.7409 25.3272 34.6181 25.2845 35.2369C25.0145 35.623 24.4404 35.6343 23.6873 35.4186C23.7157 34.9843 23.2581 32.8638 22.8574 31.6545C22.2207 29.7214 24.2216 29.7782 24.449 30.6071L24.9463 32.6878Z"
                              fill="#293B29"/>
                        <path d="M35.3031 28.0097C35.9653 29.6873 36.403 31.0811 36.4285 31.9781C36.1955 32.3897 35.6242 32.4522 34.854 32.3102C34.8313 31.5069 34.3566 29.9939 33.6575 28.2198L35.3031 28.0097Z"
                              fill="#293B29"/>
                        <path d="M8.35687 30.4226C7.73161 32.1314 6.59476 35.623 6.71128 36.3979C6.93013 36.6222 7.63213 37.0139 8.18919 36.8918C8.57856 35.9579 9.47383 32.5572 10.0536 31.0414C10.4316 30.0564 8.95656 29.5057 8.35687 30.4226Z"
                              fill="#293B29"/>
                        <path d="M15.8544 33.2981C15.232 35.0069 14.908 35.2198 15.0245 35.9948C15.2405 36.219 16.0079 36.3184 16.5649 36.1963C16.9969 35.2312 16.9856 35.0779 17.5739 33.4656L15.8544 33.2981Z"
                              fill="#293B29"/>
                        <path d="M7.14613 35.7223C5.56023 36.29 4.15622 36.8322 3.52242 37.2977C3.34621 37.5788 3.36611 38.3282 4.05674 38.0585C4.90654 37.7264 5.94391 37.2438 7.24276 36.7868L7.14613 35.7223Z"
                              fill="#293B29"/>
                        <path d="M6.81643 35.6598C6.302 37.2608 5.89558 38.4502 5.87853 39.2337C5.67105 39.9774 6.34179 40.125 6.68001 39.9093C7.01253 39.018 7.23706 37.7406 7.72022 36.2304L6.81643 35.6598Z"
                              fill="#293B29"/>
                        <path d="M7.68612 35.745C8.70644 37.0763 9.08729 38.6404 9.37434 39.3557C9.37718 39.614 9.2095 40.0654 8.60981 39.8809C7.97602 39.1059 6.96991 36.1026 6.71127 36.3979L7.68612 35.745Z"
                              fill="#293B29"/>
                        <path d="M15.7236 35.0666C14.1406 35.6343 12.7337 36.1793 12.1028 36.6449C11.9266 36.9259 11.9436 37.6753 12.6371 37.4056C13.4869 37.0707 14.5243 36.5881 15.8231 36.1311L15.7236 35.0666Z"
                              fill="#293B29"/>
                        <path d="M15.3968 35.0041C14.8824 36.6051 14.4731 37.7973 14.4589 38.5808C14.2486 39.3217 14.9193 39.4722 15.2575 39.2564C15.5929 38.3651 15.8146 37.0848 16.3006 35.5747L15.3968 35.0041Z"
                              fill="#293B29"/>
                        <path d="M16.2665 35.0921C17.2868 36.4206 17.6648 37.9875 17.9547 38.7029C17.9547 38.9612 17.787 39.4097 17.1874 39.2252C16.5536 38.4502 15.5503 35.4498 15.2917 35.7422L16.2665 35.0921Z"
                              fill="#293B29"/>
                        <path d="M24.1363 34.5953C23.2865 36.0487 22.5589 37.3659 22.3714 38.1266C22.4168 38.4559 22.9142 39.0208 23.2695 38.3679C23.7072 37.5674 24.1932 36.5313 24.8952 35.3504L24.1363 34.5953Z"
                              fill="#293B29"/>
                        <path d="M23.8436 34.76C24.4774 36.3155 24.9321 37.4907 25.4238 38.1011C25.7393 38.805 26.3504 38.4871 26.4697 38.1067C26.1542 37.2097 25.5034 36.0856 24.9037 34.6152L23.8436 34.76Z"
                              fill="#293B29"/>
                        <path d="M24.5655 34.2689C26.2026 34.6322 27.5014 35.5888 28.1807 35.9522C28.3484 36.1509 28.5104 36.6022 27.9306 36.8464C26.9472 36.659 24.2472 35.0012 24.2386 35.393L24.5655 34.2689Z"
                              fill="#293B29"/>
                        <path d="M35.1041 31.5977C34.2571 33.0483 33.5267 34.3682 33.342 35.129C33.3875 35.4583 33.8848 36.0203 34.2401 35.3703C34.6778 34.5698 35.1638 33.5337 35.8629 32.35L35.1041 31.5977Z"
                              fill="#293B29"/>
                        <path d="M34.8142 31.7595C35.448 33.3179 35.9027 34.4931 36.3944 35.1035C36.7099 35.8046 37.321 35.4895 37.4403 35.1091C37.122 34.2093 36.474 33.0852 35.8743 31.6176L34.8142 31.7595Z"
                              fill="#293B29"/>
                        <path d="M35.5361 31.2685C37.1732 31.6318 38.472 32.5913 39.1513 32.9546C39.319 33.1505 39.481 33.6047 38.9012 33.846C37.9178 33.6586 35.2178 32.0037 35.2093 32.3926L35.5361 31.2685Z"
                              fill="#293B29"/>
                        <path d="M18.3356 17.4357C19.9328 17.5549 22.6783 17.3875 25.1908 17.0553C27.581 16.7431 29.5989 16.3741 30.5055 15.795C30.6448 15.5083 30.5652 15.1563 30.3293 14.7617C30.1616 14.4807 29.7382 14.6113 29.7382 14.6113C28.8287 15.1052 26.9927 15.3777 25.0345 15.636C22.6044 15.954 20.0579 16.1101 18.4322 16.0022C18.1252 15.9823 17.986 16.1158 17.8666 16.4422C17.6307 17.0922 17.7899 17.3931 18.3356 17.4357Z"
                              fill="#293B29"/>
                    </svg>
                    <span class="font-semibold text-base text-title-color">
                        жыбий рыр
                    </span>
                </a>
            </header>
            <main>
                <div class="font-semibold text-[25px] text-title-color mb-[30px]">
                    Команда
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 grid-rows-3 gap-7 pb-10">
                    <div class="flex items-center gap-[15px] rounded-[10px] p-[30px] shadow-card">
                        <div class="w-[100px] h-[100px] rounded-full overflow-hidden">
                            <img class="object-cover" src="misha.jpg" alt=".">
                        </div>
                        <div class="flex flex-col gap-[15px]">
                            <div>
                                <h3 class="font-semibold text-xl text-title-color">
                                    Михаил Профацкий
                                </h3>
                                <span class="font-normal text-base text-subtitle leading-4">
                                Капитан
                            </span>
                            </div>
                            <div class="flex gap-[20px]">
                                <a href="https://t.me/profatsky" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_20_316)">
                                            <path d="M7.8474 13.1508L7.51657 17.8042C7.98991 17.8042 8.1949 17.6008 8.44074 17.3567L10.6599 15.2358L15.2582 18.6033C16.1016 19.0733 16.6957 18.8258 16.9232 17.8275L19.9416 3.68416L19.9424 3.68333C20.2099 2.43666 19.4916 1.94916 18.6699 2.25499L0.928237 9.04749C-0.282596 9.51749 -0.264263 10.1925 0.722404 10.4983L5.25824 11.9092L15.7941 5.31666C16.2899 4.98833 16.7407 5.16999 16.3699 5.49833L7.8474 13.1508Z" fill="#039BE5" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_20_316">
                                                <rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    @profatsky
                                </span>
                                </a>
                                <a href="https://github.com/profatsky" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.98694 19.0526C7.59221 19.0526 7.76326 18.8158 7.76326 18.5132C7.76326 18.2105 7.76326 17.5526 7.7501 16.6184C4.60537 17.2895 3.93431 15.1184 3.93431 15.1184C3.42115 13.8421 2.67115 13.4868 2.67115 13.4868C1.64484 12.8026 2.7501 12.8158 2.7501 12.8158C3.88168 12.8947 4.48694 13.9605 4.48694 13.9605C5.5001 15.671 7.13168 15.171 7.77642 14.8816C7.82905 14.3158 8.07905 13.7763 8.5001 13.3816C5.98694 13.1053 3.34221 12.1447 3.34221 7.88158C3.32905 6.77631 3.7501 5.69737 4.51326 4.89473C4.38168 4.61842 4.0001 3.48684 4.60537 1.94736C4.60537 1.94736 5.55273 1.64473 7.72379 3.0921C9.57905 2.5921 11.5264 2.5921 13.3817 3.0921C15.5264 1.65789 16.4869 1.94736 16.4869 1.94736C17.0922 3.47368 16.7106 4.60526 16.6054 4.89473C17.3685 5.69737 17.7764 6.77631 17.7633 7.88158C17.7633 12.1579 15.1185 13.0921 12.5922 13.3684C12.9869 13.6974 13.3554 14.3816 13.3554 15.421C13.3554 16.921 13.3422 18.1053 13.3422 18.4605C13.3422 18.75 13.4738 18.9868 14.1185 18.9868L6.98694 19.0526Z" fill="#5C6BC0" />
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    profatsky
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-[15px] rounded-[10px] p-[30px] shadow-card">
                        <div class="w-[100px] h-[100px] rounded-full overflow-hidden">
                            <img class="object-cover" src="denchik.jpg" alt=".">
                        </div>
                        <div class="flex flex-col gap-[15px]">
                            <div>
                                <h3 class="font-semibold text-xl text-title-color">
                                    Корбаков Денис
                                </h3>
                                <span class="font-normal text-base text-subtitle leading-4">
                                Backend - разработчик
                            </span>
                            </div>
                            <div class="flex gap-[20px]">
                                <a href="https://t.me/Deniskorbakov" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_20_316)">
                                            <path d="M7.8474 13.1508L7.51657 17.8042C7.98991 17.8042 8.1949 17.6008 8.44074 17.3567L10.6599 15.2358L15.2582 18.6033C16.1016 19.0733 16.6957 18.8258 16.9232 17.8275L19.9416 3.68416L19.9424 3.68333C20.2099 2.43666 19.4916 1.94916 18.6699 2.25499L0.928237 9.04749C-0.282596 9.51749 -0.264263 10.1925 0.722404 10.4983L5.25824 11.9092L15.7941 5.31666C16.2899 4.98833 16.7407 5.16999 16.3699 5.49833L7.8474 13.1508Z" fill="#039BE5" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_20_316">
                                                <rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    @Deniskorbakov
                                </span>
                                </a>
                                <a href="https://github.com/deniskorbakov" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.98694 19.0526C7.59221 19.0526 7.76326 18.8158 7.76326 18.5132C7.76326 18.2105 7.76326 17.5526 7.7501 16.6184C4.60537 17.2895 3.93431 15.1184 3.93431 15.1184C3.42115 13.8421 2.67115 13.4868 2.67115 13.4868C1.64484 12.8026 2.7501 12.8158 2.7501 12.8158C3.88168 12.8947 4.48694 13.9605 4.48694 13.9605C5.5001 15.671 7.13168 15.171 7.77642 14.8816C7.82905 14.3158 8.07905 13.7763 8.5001 13.3816C5.98694 13.1053 3.34221 12.1447 3.34221 7.88158C3.32905 6.77631 3.7501 5.69737 4.51326 4.89473C4.38168 4.61842 4.0001 3.48684 4.60537 1.94736C4.60537 1.94736 5.55273 1.64473 7.72379 3.0921C9.57905 2.5921 11.5264 2.5921 13.3817 3.0921C15.5264 1.65789 16.4869 1.94736 16.4869 1.94736C17.0922 3.47368 16.7106 4.60526 16.6054 4.89473C17.3685 5.69737 17.7764 6.77631 17.7633 7.88158C17.7633 12.1579 15.1185 13.0921 12.5922 13.3684C12.9869 13.6974 13.3554 14.3816 13.3554 15.421C13.3554 16.921 13.3422 18.1053 13.3422 18.4605C13.3422 18.75 13.4738 18.9868 14.1185 18.9868L6.98694 19.0526Z" fill="#5C6BC0" />
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    deniskorbakov
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-[15px] rounded-[10px] p-[30px] shadow-card">
                        <div class="w-[100px] h-[100px] rounded-full overflow-hidden">
                            <img class="object-cover" src="roma.jpg" alt=".">
                        </div>
                        <div class="flex flex-col gap-[15px]">
                            <div>
                                <h3 class="font-semibold text-xl text-title-color">
                                    Игнатушин Александр
                                </h3>
                                <span class="font-normal text-base text-subtitle leading-4">
                                Frontend - разработчик
                            </span>
                            </div>
                            <div class="flex gap-[20px]">
                                <a href="https://t.me/alex_ignatushin" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_20_316)">
                                            <path d="M7.8474 13.1508L7.51657 17.8042C7.98991 17.8042 8.1949 17.6008 8.44074 17.3567L10.6599 15.2358L15.2582 18.6033C16.1016 19.0733 16.6957 18.8258 16.9232 17.8275L19.9416 3.68416L19.9424 3.68333C20.2099 2.43666 19.4916 1.94916 18.6699 2.25499L0.928237 9.04749C-0.282596 9.51749 -0.264263 10.1925 0.722404 10.4983L5.25824 11.9092L15.7941 5.31666C16.2899 4.98833 16.7407 5.16999 16.3699 5.49833L7.8474 13.1508Z" fill="#039BE5" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_20_316">
                                                <rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    @alex_ignatushin
                                </span>
                                </a>
                                <a href="https://github.com/alexandrignatushin" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.98694 19.0526C7.59221 19.0526 7.76326 18.8158 7.76326 18.5132C7.76326 18.2105 7.76326 17.5526 7.7501 16.6184C4.60537 17.2895 3.93431 15.1184 3.93431 15.1184C3.42115 13.8421 2.67115 13.4868 2.67115 13.4868C1.64484 12.8026 2.7501 12.8158 2.7501 12.8158C3.88168 12.8947 4.48694 13.9605 4.48694 13.9605C5.5001 15.671 7.13168 15.171 7.77642 14.8816C7.82905 14.3158 8.07905 13.7763 8.5001 13.3816C5.98694 13.1053 3.34221 12.1447 3.34221 7.88158C3.32905 6.77631 3.7501 5.69737 4.51326 4.89473C4.38168 4.61842 4.0001 3.48684 4.60537 1.94736C4.60537 1.94736 5.55273 1.64473 7.72379 3.0921C9.57905 2.5921 11.5264 2.5921 13.3817 3.0921C15.5264 1.65789 16.4869 1.94736 16.4869 1.94736C17.0922 3.47368 16.7106 4.60526 16.6054 4.89473C17.3685 5.69737 17.7764 6.77631 17.7633 7.88158C17.7633 12.1579 15.1185 13.0921 12.5922 13.3684C12.9869 13.6974 13.3554 14.3816 13.3554 15.421C13.3554 16.921 13.3422 18.1053 13.3422 18.4605C13.3422 18.75 13.4738 18.9868 14.1185 18.9868L6.98694 19.0526Z" fill="#5C6BC0" />
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    alexandrignatushin
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-[15px] rounded-[10px] p-[30px] shadow-card">
                        <div class="w-[100px] h-[100px] rounded-full overflow-hidden">
                            <img class="object-cover" src="roma.jpg" alt=".">
                        </div>
                        <div class="flex flex-col gap-[15px]">
                            <div>
                                <h3 class="font-semibold text-xl text-title-color">
                                    Корчнев Роман
                                </h3>
                                <span class="font-normal text-base text-subtitle leading-4">
                                Backend - разработчик
                            </span>
                            </div>
                            <div class="flex gap-[20px]">
                                <a href="https://t.me/romo4ko" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_20_316)">
                                            <path d="M7.8474 13.1508L7.51657 17.8042C7.98991 17.8042 8.1949 17.6008 8.44074 17.3567L10.6599 15.2358L15.2582 18.6033C16.1016 19.0733 16.6957 18.8258 16.9232 17.8275L19.9416 3.68416L19.9424 3.68333C20.2099 2.43666 19.4916 1.94916 18.6699 2.25499L0.928237 9.04749C-0.282596 9.51749 -0.264263 10.1925 0.722404 10.4983L5.25824 11.9092L15.7941 5.31666C16.2899 4.98833 16.7407 5.16999 16.3699 5.49833L7.8474 13.1508Z" fill="#039BE5" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_20_316">
                                                <rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    @romo4ko
                                </span>
                                </a>
                                <a href="https://github.com/romo4ko" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.98694 19.0526C7.59221 19.0526 7.76326 18.8158 7.76326 18.5132C7.76326 18.2105 7.76326 17.5526 7.7501 16.6184C4.60537 17.2895 3.93431 15.1184 3.93431 15.1184C3.42115 13.8421 2.67115 13.4868 2.67115 13.4868C1.64484 12.8026 2.7501 12.8158 2.7501 12.8158C3.88168 12.8947 4.48694 13.9605 4.48694 13.9605C5.5001 15.671 7.13168 15.171 7.77642 14.8816C7.82905 14.3158 8.07905 13.7763 8.5001 13.3816C5.98694 13.1053 3.34221 12.1447 3.34221 7.88158C3.32905 6.77631 3.7501 5.69737 4.51326 4.89473C4.38168 4.61842 4.0001 3.48684 4.60537 1.94736C4.60537 1.94736 5.55273 1.64473 7.72379 3.0921C9.57905 2.5921 11.5264 2.5921 13.3817 3.0921C15.5264 1.65789 16.4869 1.94736 16.4869 1.94736C17.0922 3.47368 16.7106 4.60526 16.6054 4.89473C17.3685 5.69737 17.7764 6.77631 17.7633 7.88158C17.7633 12.1579 15.1185 13.0921 12.5922 13.3684C12.9869 13.6974 13.3554 14.3816 13.3554 15.421C13.3554 16.921 13.3422 18.1053 13.3422 18.4605C13.3422 18.75 13.4738 18.9868 14.1185 18.9868L6.98694 19.0526Z" fill="#5C6BC0" />
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    romo4ko
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-[15px] rounded-[10px] p-[30px] shadow-card">
                        <div class="w-[100px] h-[100px] rounded-full overflow-hidden">
                            <img class="object-cover" src="sanya.jpg" alt=".">
                        </div>
                        <div class="flex flex-col gap-[15px]">
                            <div>
                                <h3 class="font-semibold text-xl text-title-color">
                                    Александр Коваленко
                                </h3>
                                <span class="font-normal text-base text-subtitle leading-4">
                                Frontend - разработчик
                            </span>
                            </div>
                            <div class="flex gap-[20px]">
                                <a href="https://t.me/alexanderrkovalenko" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_20_316)">
                                            <path d="M7.8474 13.1508L7.51657 17.8042C7.98991 17.8042 8.1949 17.6008 8.44074 17.3567L10.6599 15.2358L15.2582 18.6033C16.1016 19.0733 16.6957 18.8258 16.9232 17.8275L19.9416 3.68416L19.9424 3.68333C20.2099 2.43666 19.4916 1.94916 18.6699 2.25499L0.928237 9.04749C-0.282596 9.51749 -0.264263 10.1925 0.722404 10.4983L5.25824 11.9092L15.7941 5.31666C16.2899 4.98833 16.7407 5.16999 16.3699 5.49833L7.8474 13.1508Z" fill="#039BE5" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_20_316">
                                                <rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    @alexanderrkovalenko
                                </span>
                                </a>
                                <a href="https://github.com/alexander1934" target="_blank" class="flex gap-[5px] group">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.98694 19.0526C7.59221 19.0526 7.76326 18.8158 7.76326 18.5132C7.76326 18.2105 7.76326 17.5526 7.7501 16.6184C4.60537 17.2895 3.93431 15.1184 3.93431 15.1184C3.42115 13.8421 2.67115 13.4868 2.67115 13.4868C1.64484 12.8026 2.7501 12.8158 2.7501 12.8158C3.88168 12.8947 4.48694 13.9605 4.48694 13.9605C5.5001 15.671 7.13168 15.171 7.77642 14.8816C7.82905 14.3158 8.07905 13.7763 8.5001 13.3816C5.98694 13.1053 3.34221 12.1447 3.34221 7.88158C3.32905 6.77631 3.7501 5.69737 4.51326 4.89473C4.38168 4.61842 4.0001 3.48684 4.60537 1.94736C4.60537 1.94736 5.55273 1.64473 7.72379 3.0921C9.57905 2.5921 11.5264 2.5921 13.3817 3.0921C15.5264 1.65789 16.4869 1.94736 16.4869 1.94736C17.0922 3.47368 16.7106 4.60526 16.6054 4.89473C17.3685 5.69737 17.7764 6.77631 17.7633 7.88158C17.7633 12.1579 15.1185 13.0921 12.5922 13.3684C12.9869 13.6974 13.3554 14.3816 13.3554 15.421C13.3554 16.921 13.3422 18.1053 13.3422 18.4605C13.3422 18.75 13.4738 18.9868 14.1185 18.9868L6.98694 19.0526Z" fill="#5C6BC0" />
                                    </svg>
                                    <span class="font-medium text-base text-subtitle group-hover:text-hover-title">
                                    alexander1934
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </body>

    </body>
</html>
