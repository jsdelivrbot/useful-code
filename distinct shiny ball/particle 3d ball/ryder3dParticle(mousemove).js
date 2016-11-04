function Ryder3dParticle(option) {
    var color = ["#cccccc", "#0082cc", "#ffffff"];
    var particle_number = option.number;
    var update_frequency = 60 / 1000;

    var angle_demul = option.verticle;
    var z_angle_demul = option.horizon;
    var max_radius = 2;
    var min_radius = 0.5;

    // Get canvas.
    var canvas = option.el;

    // Get canvas context.
    var canvas_ctx = canvas.getContext('2d');

    // Set size.
    canvas.width = $(canvas).parent().width();
    canvas.height = $(canvas).parent().height();

    var center_x = canvas.width / 2;
    var center_y = canvas.height / 2;

    var max_x = center_x;
    var max_y = center_y;

    //縮小一些預防放大時超過
    var range = (max_x > max_y) ? max_y - 50 : max_x - 50;

    // Generate particles
    var particles = [];

    // mousemove
    var _mx = 0,
        _my = 0,
        vpX = $(window).width() / 2,
        vpY = $(window).height() / 2,
        _m_angleX = 0,
        _m_angleY = 0;

    $(canvas).parent().parent().on("mousemove", function(e) {
        _mx = e.pageX;
        _my = e.pageY - $(this).offset().top;
        _m_angleX = (_my - vpY) * 0.00005;
        _m_angleY = (_mx - vpX) * 0.00005;
    })

    // OBJECTS
    function Particle() {
        this.angle = Math.random() * 2 * Math.PI;
        this.vangle = Math.random() / angle_demul;
        this.zangle = Math.random() * 2 * Math.PI;
        this.zvelangle = Math.random() / z_angle_demul;
        this.x;
        this.y;
        this.r = max_radius * Math.random();
        this.color = color[Math.floor(Math.random() * 3)];

        this.Move = function(x, y) {
            // Update coordinates
            this.y = center_y + (range + y * 1300) * Math.cos(this.angle);
            this.x = center_x + (range + y * 1300) * Math.cos(this.zangle) * Math.sin(this.angle);

            // Update angle
            // verticla
            this.angle += (this.vangle + x);
            // horizontal
            this.zangle += (this.zvelangle + y);

            // Change radius on Z axis
            if (Math.sin(this.zangle) > 0.5 && this.r < max_radius)
                this.r += 0.01;
            else if (this.r > min_radius)
                this.r -= 0.01;
        }
    }

    function UpdateParticles() {
        canvas_ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (var index in particles) {
            particles[index].Move(_m_angleX, _m_angleY);
            DrawParticle(particles[index]);
        }
        window.requestAnimationFrame(UpdateParticles);
    }

    function DrawParticle(particle) {
        canvas_ctx.beginPath();
        canvas_ctx.fillStyle = particle.color;
        canvas_ctx.arc(particle.x, particle.y, particle.r, 0, Math.PI * 2);
        canvas_ctx.fill();
    }

    this.GenerateParticles=function (num_particles) {
        for (var i = 0; i < num_particles; i++) {
            particles.push(new Particle());
        }
        UpdateParticles();
    }

    this.GenerateParticles(particle_number);
}
