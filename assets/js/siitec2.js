var siitec2 = (function() {
    function attachAnimReposition() {
        let elements = document.getElementsByClassName('anim-reposition');
        for (let i = 0, el; el = elements[i]; i++) {
            el.dataset.prevTop = el.offsetTop;
            el.dataset.prevLeft = el.offsetLeft;
            el.addEventListener("animationend",() => {
                console.log("animationend");
            });
        }
        let windowOnResize = function(e) {
            for (let i = 0, el; el = elements[i]; i++) {
                let prevTop = el.dataset.prevTop;
                let prevLeft = el.dataset.prevLeft;
                if (el.offsetTop == prevTop && el.offsetLeft == prevLeft) {
                    continue;
                }
                let deltaTop = prevTop - el.offsetTop;
                let deltaLeft = prevLeft - el.offsetLeft;

                let animation = el.animate([
                    { 'transform': 'translate('+deltaLeft+'px,'+deltaTop+'px)' },
                    { 'transform': 'translate(0px,0px)' }
                ], { 'duration': 600, 'easing': 'ease-in-out' });
                animation.onfinish = function() {
                    el.dataset.prevTop = el.offsetTop;
                    el.dataset.prevLeft = el.offsetLeft;
                }
            }
        }
        
        window.addEventListener("resize", windowOnResize);
    }
    function attachRevealEffect() {
        let reveals = document.querySelectorAll('.reveal-container:not(.reveal-attached)');
        let spot = document.createElement('div');
        spot.className = 'reveal-spot';
        spot.setAttribute('unselectable','on');
        spot.tabIndex = -1;
        for (let i = 0, reveal; reveal = reveals[i]; i++) {
            let size = reveal.offsetHeight < reveal.offsetWidth ?
                reveal.offsetHeight :
                reveal.offsetWidth;
            spot.style.setProperty('--spot-blur', (size/4)+'px');
            spot.style.width = size + 'px';
            spot.style.height = size + 'px';

            reveal.addEventListener('mouseenter',function(e) {
                let el = e.target || this;
                el.insertBefore(spot, el.firstChild);
            });
            reveal.addEventListener('mouseleave',function(e) {
                let el = e.target || this;
                el.removeChild(spot);
            });
            reveal.addEventListener('mousemove', function(e) {
                let el = this;
                let bounds = el.getBoundingClientRect();
                let x = e.clientX - bounds.left;
                let y = e.clientY - bounds.top;
                let hs = spot.offsetWidth / 2;

                x = (x - hs) + 'px';
                y = (y - hs) + 'px';

                spot.style.transform = 'translate('+x+','+y+')';
            });
            reveal.classList.add('reveal-attached');
        }
    }
    siitec2.updateUI = function() {
        let requiredInputs = document.querySelectorAll('input[id],select[id],textarea[id]');
        for (let i = 0, labels, input; input = requiredInputs[i]; i++) {
            if (!input.required) continue;
            labels = document.querySelectorAll("label[for='"+input.id+"']");
            for (let j = 0, label; label = labels[j]; j++) {
                label.classList.add('s2-required');
            }
        }
        attachRevealEffect();
        attachAnimReposition();
    }
    siitec2.attachEvents = function() {
        window.addEventListener('keydown', function(e) {
            if (e.key != "Tab") return;
            this.document.documentElement.classList.add('s2-focus-visible');
        }, true);
        window.addEventListener("pointerdown", function(e) {
            this.document.documentElement.classList.remove('s2-focus-visible');
        }, true);
        window.addEventListener("scroll", function(e) {
            let root = this.document.documentElement;
            root.classList.toggle('s2-scrolled',this.scrollY > 0);
            let s2Header = document.getElementById('s2Header');
            let shadow = Math.min(1, this.scrollY / s2Header.clientHeight / 2);
            s2Header.style.setProperty('--shadow', shadow);
            
        });
    }
    function siitec2() {

    }
    return siitec2;
})();

window.addEventListener("DOMContentLoaded", function(e) {
    siitec2.attachEvents();
    siitec2.updateUI();
});