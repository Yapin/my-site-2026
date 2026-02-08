var particleSystem = null;
var stage = null;
var particleConfig = null;
var BP_SP = 768;

function getParticleConfig(width, height) {
    return {
        "bgColor": "#00000",
        "width": width,
        "height": height,
        "emitFrequency": 50,
        "startX": width * 0.44,
        "startXVariance": width * 0.88,
        "startY": height * 0.39,
        "startYVariance": height * 0.93,
        "initialDirection": "0",
        "initialDirectionVariance": "360",
        "initialSpeed": 0,
        "initialSpeedVariance": 20,
        "friction": 0.0775,
        "accelerationSpeed": 0.0925,
        "accelerationDirection": 273,
        "startScale": 0.76,
        "startScaleVariance": "1",
        "finishScale": 0,
        "finishScaleVariance": "0",
        "lifeSpan": 40,
        "lifeSpanVariance": 196,
        "startAlpha": "1",
        "startAlphaVariance": "0",
        "finishAlpha": "0.35",
        "finishAlphaVariance": 0.5,
        "shapeIdList": ["blur_circle"],
        "startColor": {
            "hue": 48,
            "hueVariance": 41,
            "saturation": "71",
            "saturationVariance": "78",
            "luminance": "83",
            "luminanceVariance": "16"
        },
        "blendMode": true,
        "alphaCurveType": "1",
        "VERSION": "1.0.0"
    };
}

function getCanvasSize() {
    var canvas = document.getElementById("myCanvas");
    if (!canvas || !canvas.parentElement) return { w: 1024, h: 768 };
    var rect = canvas.parentElement.getBoundingClientRect();
    var w = Math.max(1, Math.floor(rect.width));
    var h = Math.max(1, Math.floor(rect.height));
    return { w: w, h: h };
}

function applyCanvasSize() {
    var canvas = document.getElementById("myCanvas");
    if (!canvas || !particleSystem) return;
    var size = getCanvasSize();
    canvas.width = size.w;
    canvas.height = size.h;
    particleConfig = getParticleConfig(size.w, size.h);
    particleSystem.importFromJson(particleConfig);
    if (stage) stage.update();
}

window.addEventListener("load", function () {
    var canvas = document.getElementById("myCanvas");
    if (!canvas || !window.createjs || !window.particlejs) return;

    var size = getCanvasSize();
    canvas.width = size.w;
    canvas.height = size.h;

    stage = new createjs.Stage("myCanvas");
    particleSystem = new particlejs.ParticleSystem();
    stage.addChild(particleSystem.container);

    particleConfig = getParticleConfig(size.w, size.h);
    particleSystem.importFromJson(particleConfig);

    createjs.Ticker.framerate = 60;
    createjs.Ticker.timingMode = createjs.Ticker.RAF;
    createjs.Ticker.addEventListener("tick", handleTick);

    window.addEventListener("resize", function () {
        applyCanvasSize();
    });
});

function handleTick() {
    if (particleSystem) particleSystem.update();
    if (stage) stage.update();
}