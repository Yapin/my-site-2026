(() => {
    function initMvParticles() {
        const host = document.getElementById("mv-particles");
        if (!host || !window.tsParticles) return false;

        const prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

        // 端末負荷に応じて粒数を調整（キラキラをさらに目立たせる）
        const isMobile = window.matchMedia("(max-width: 768px)").matches;
        const baseCount = prefersReduced ? 0 : (isMobile ? 48 : 90);

        // bundle で確実に動くよう、circle のみ
        const config = {
            fullScreen: { enable: false },
            detectRetina: true,
            fpsLimit: 60,
            background: { color: { value: "transparent" } },

            particles: {
                number: { value: baseCount, density: { enable: true, area: isMobile ? 800 : 650 } },
                color: { value: ["#ffffff", "#fff8e7", "#fff2d8", "#ffe2f0"] },
                shape: { type: "circle" },

                opacity: {
                    value: { min: 0.55, max: 1 },
                    animation: { enable: true, speed: 2.2, minimumValue: 0.4, sync: false }
                },

                size: {
                    value: { min: 3.5, max: 8 },
                    animation: { enable: true, speed: 2.2, minimumValue: 1, sync: false }
                },

                move: {
                    enable: true,
                    speed: isMobile ? 0.9 : 1.4,
                    direction: "top",
                    straight: false,
                    random: true,
                    outModes: { default: "out" }
                },

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

        const KEY = "__mv_particles_inited__";
        if (host[KEY]) return true;
        host[KEY] = true;

        host.style.width = "100%";
        host.style.height = "100%";

        function doLoad() {
            const engine = window.tsParticles;
            let promise = null;
            // v3: load({ id, options }) または load(id, options)、互換で particlesJS(id, options)
            if (typeof engine.load === "function") {
                try {
                    promise = engine.load({ id: "mv-particles", options: config });
                } catch (e) {
                    promise = engine.load("mv-particles", config);
                }
            }
            if (!promise && typeof window.particlesJS === "function") {
                promise = window.particlesJS("mv-particles", config);
            }
            if (promise && typeof promise.catch === "function") {
                promise.catch(function (err) {
                    console.warn("mv-particles: load failed", err);
                });
            }
        }

        // レイアウト確定後に load（コンテナが 0 だと描画されない）
        requestAnimationFrame(function () {
            requestAnimationFrame(doLoad);
        });
        return true;
    }

    // tsParticles の読み込み完了を待つ（CDN が遅い場合に対応）
    function runWhenReady() {
        if (window.tsParticles && document.getElementById("mv-particles")) {
            initMvParticles();
            return;
        }
        let attempts = 0;
        const maxAttempts = 50; // 約5秒
        const timer = setInterval(function () {
            attempts++;
            if (window.tsParticles && document.getElementById("mv-particles")) {
                clearInterval(timer);
                initMvParticles();
                return;
            }
            if (attempts >= maxAttempts) {
                clearInterval(timer);
            }
        }, 100);
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", runWhenReady);
    } else {
        runWhenReady();
    }
})();