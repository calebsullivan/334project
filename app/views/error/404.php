<!DOCTYPE HTML>
<html>
<head>
	<style type="text/css">
		body, html { overflow: hidden; background-color:#000;}
	</style>
	
</head>
<body>

<canvas id="scene"></canvas>

<script type="text/javascript">
	(function() {

    var __PI2__ = Math.PI * 2,
    __NB_PARTICLES__ = 20,
    __GLOBAL_ALPHA__ = 0.3,
    __MAX_SIZE__ = 50,
    __MAX_SPEED__ = 5,
    __COLORS__ = [];

    var numbers = [0, 125, 255];
    for (var i = 0; i <= 1; i++) {
        for (var j = 0; j <= 1; j++) {
            for (var k = 0; k <= 1; k++) {
                __COLORS__.push([numbers[i], numbers[j], numbers[k]]);
            }
        }
    }

    window.requestAnimFrame = (function() {
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(callback) {
            window.setTimeout(callback, 1000 / 60);
        };
    })();

    // Simple Vector Class
    var Vec2 = {};

    Vec2.create = function(a, b) {
        return new Float32Array([a, b]);
    };

    Vec2.add = function(a, b, out) {
        out[0] = a[0] + b[0];
        out[1] = a[1] + b[1];
    };

    Vec2.rotate = function(a, angle, b) {
        var theSin = Math.sin(angle),
        theCos = Math.cos(angle);
        b[0] = a[0] * theCos - a[1] * theSin;
        b[1] = a[0] * theSin + a[1] * theCos;
    }

    var anim = {
        init: function(canvas) {
            this.canvas = canvas;
            this.ctx = canvas.getContext('2d');
            this.width = canvas.width;
            this.height = canvas.height;
            this.particles = [];
        },

        start: function() {
            var that = this; (function animloop() {
                requestAnimFrame(animloop);
                that.render();
            })();
        },

        render: function() {
            this.fade();
            var particles = this.particles,
            particle = null,
            i = 0,
            j = 0;
            for (j = particles.length; i < j; i = i + 1) {
                particle = particles[i];
                particle.iterate();

                this.checkBounds(particle);
            };
        },

        checkBounds: function(particle) {
            var bounds = particle.getBounds();
            if (bounds.min[0] <= 0) {
                particle.velocity[0] = Math.abs(particle.velocity[0]);
            } else if (bounds.max[0] >= this.width) {
                particle.velocity[0] = -Math.abs(particle.velocity[0]);
            }

            if (bounds.min[1] <= 0) {
                particle.velocity[1] = Math.abs(particle.velocity[1]);
            } else if (bounds.max[1] >= this.height) {
                particle.velocity[1] = -Math.abs(particle.velocity[1]);
            }

        },

        addParticle: function(particle) {
            this.particles.push(particle);
        },

        fade: function() {
            this.ctx.fillStyle = 'rgba(240, 243, 251, 0.3)';
            this.ctx.fillRect(0, 0, this.width, this.height);
        }
    };

    function extend(target) {
        Array.prototype.slice.call(arguments, 1).forEach(function(source) {
            Object.getOwnPropertyNames(source).forEach(function(name) {
                target[name] = source[name]
                })
            })
            return target
    }

    var Shape = {
        pos: null,
        size: null,
        velocity: null,
        color: null,
        angle: null,
        rotation: null,
        plain: null,

        ctx: null,

        init: function(param) {
            var that = this;
            Object.keys(param).forEach(function(key) {
                that[key] = param[key];
            });
        },

        iterate: function() {
            this.render();
            Vec2.add(this.pos, this.velocity, this.pos);
        },

        getBounds: (function() {
            var min = Vec2.create(0, 0),
            points = null,
            max = Vec2.create(0, 0),
            rot = Vec2.create(0, 0),
            ret = {
                min: min,
                max: max
            },
            ctx = null,
            i = 0;
            return function() {
                points = this.limits;
                ctx = this.ctx;

                min[0] = this.pos[0];
                min[1] = this.pos[1];
                max[0] = this.pos[0];
                max[1] = this.pos[1];

                i = points.length;
                while (i--) {

                    Vec2.rotate(points[i], this.angle, rot);
                    Vec2.add(rot, this.pos, rot);

                    if (rot[0] < min[0]) {
                        min[0] = rot[0];
                    } else if (rot[0] >= max[0]) {
                        max[0] = rot[0];
                    }

                    if (rot[1] < min[1]) {
                        min[1] = rot[1];
                    } else if (rot[1] >= max[1]) {
                        max[1] = rot[1];
                    }
                }

                ret.min = min;
                ret.max = max;

                return ret;
            }
        })()
        };

    var Shapes = {
        circle: extend({}, Shape, {
            render: function() {
                var ctx = this.ctx,
                size = this.size;
                ctx.save();

                ctx.translate(this.pos[0], this.pos[1]);
                // center
                ctx.beginPath();
                ctx.arc(0, 0, size, 0, __PI2__);
                ctx.closePath();

                if (this.plain) {
                    ctx.fillStyle = this.color;
                    ctx.fill();
                } else {
                    ctx.strokeStyle = this.color;
                    ctx.stroke();
                }

                ctx.restore();
            },

            extra: function() {
                var size = this.size;
                this.limits = [[0, -size], [size, 0], [0, size], [ - size, 0]];
            }
        }),

        triangle: extend({}, Shape, {
            extra: function() {
                this.half = this.size / 2,
                this.h = this.size * Math.sqrt(3) / 2 / 3;

                this.limits = [[0, -this.h * 2], [this.half, this.h], [ - this.half, this.h]];
            },

            render: function() {
                var ctx = this.ctx,
                h = this.h,
                half = this.half;

                this.angle += this.rotation;

                ctx.save();
                ctx.translate(this.pos[0], this.pos[1]);
                ctx.rotate(this.angle);

                ctx.beginPath();
                ctx.moveTo(0, -h * 2);
                ctx.lineTo( - half, h);
                ctx.lineTo(half, h);
                ctx.lineTo(0, -h * 2);
                ctx.closePath();

                if (this.plain) {
                    ctx.fillStyle = this.color;
                    ctx.fill();
                } else {
                    ctx.strokeStyle = this.color;
                    ctx.stroke();
                }

                ctx.restore();
            }
        }),

        square: extend({}, Shape, {

            extra: function() {
                var half = this.size / 2;

                this.limits = [[ - half, -half], [half, -half], [half, half], [ - half, half]];
            },

            render: function() {
                var ctx = this.ctx;
                this.angle += this.rotation;

                ctx.save();
                ctx.translate(this.pos[0], this.pos[1]);
                // center
                ctx.rotate(this.angle);

                var size = this.size,
                half = size / 2;

                if (this.plain) {
                    ctx.fillStyle = this.color;
                    ctx.fillRect( - half, -half, size, size);
                } else {
                    ctx.strokeStyle = this.color;
                    ctx.strokeRect( - half, -half, size, size);
                }

                ctx.restore();
            }
        })
        };

    var createShape = (function() {
        var types = Object.keys(Shapes),
        type = null;

        return function(param) {
            type = types[parseInt(Math.random() * types.length, 10)];
            var particle = extend({}, Shapes[type]);

            particle.init(param);
            if (particle.extra) {
                particle.extra();
            }

            return particle;
        };
    })();

    // anim
    var canvas = document.getElementById('scene');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    anim.init(canvas);
    function onResize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        anim.width = canvas.width;
        anim.height = canvas.height;
    }
    window.onresize = onResize;

    var i = __NB_PARTICLES__,
    param = null,
    color = null,
    size = 0;

    while (i--) {
        size = parseInt(Math.random() * __MAX_SIZE__);
        color = __COLORS__[parseInt(Math.random() * __COLORS__.length)];

        param = {
            pos: Vec2.create(parseInt(Math.random() * (canvas.width - size)) + size, parseInt(Math.random() * (canvas.height - size)) + size),
            size: size,
            velocity: Vec2.create((Math.round(Math.random() * -1) == 0 ? 0: -1) * Math.random() * __MAX_SPEED__ + 1, (Math.round(Math.random() * -1) == 0 ? 0: -1) * Math.random() * __MAX_SPEED__ + 1),
            color: 'rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',' + __GLOBAL_ALPHA__ + ')',
            angle: Math.random() * __PI2__,
            rotation: Math.random() / 100,
            plain: Math.round(Math.random()),
            ctx: anim.ctx
        };
        anim.addParticle(createShape(param));
    }

    anim.start();
})();</script>
</body>
</html>