(() => {
    const root = document.querySelector(".mv.mv--abstract");
    const host = document.getElementById("mv-particles");
    if (!root || !host || !window.tsParticles) return;

    const prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // 端末負荷に応じて粒数を調整（スマホ少なめ）
    const isMobile = window.matchMedia("(max-width: 768px)").matches;
    const baseCount = prefersReduced ? 0 : (isMobile ? 28 : 55);

    const config = {
        fullScreen: { enable: false },
        detectRetina: true,
        fpsLimit: 60,
        background: { color: { value: "transparent" } },

        particles: {
            number: { value: baseCount, density: { enable: true, area: isMobile ? 1000 : 900 } },

            // 背景の暖色トーンに合わせた色（白＋少し黄＋薄ピンク）
            color: { value: ["#ffffff", "#fff2d8", "#ffe2f0"] },

            shape: { type: "circle" },

            opacity: {
                value: { min: 0.18, max: 0.55 },
                animation: { enable: true, speed: 0.9, minimumValue: 0.12, sync: false }
            },

            size: {
                value: { min: 1.8, max: 4.2 },     // 「もう少し大きく」寄り
                animation: { enable: true, speed: 2.2, minimumValue: 1.2, sync: false }
            },

            move: {
                enable: true,
                speed: isMobile ? 0.55 : 0.75,     // 速さ（もっと速くしたいなら 0.9〜1.2）
                direction: "top",
                straight: false,
                random: true,
                outModes: { default: "out" }
            },

            // ふわっとした空気感
            blur: { enable: true, value: 0.6 },

            // キラッと感（強すぎるとチープなので控えめ）
            glow: { enable: true, color: "#ffffff", value: 0.25 },

            // 粒同士の線は無し（MVの雰囲気を壊しやすい）
            links: { enable: false }
        },

        interactivity: {
            events: {
                onHover: { enable: false },
                onClick: { enable: false },
                resize: true
            }
        }
    };

    // 同IDでの二重初期化ガード（SPA/再描画対策）
    const KEY = "__mv_particles_inited__";
    if (host[KEY]) return;
    host[KEY] = true;

    window.tsParticles.load("mv-particles", config);
})();