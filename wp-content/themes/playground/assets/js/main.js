import '../css/main.css';

console.log('Tailwind + Vite + WordPress works!');

document.addEventListener('DOMContentLoaded', () => {
  gsap.registerPlugin(SplitText, ScrollTrigger);

  let clone; // Define clone in a shared scope

  const explodeImage = () => {
    const img = document.getElementById('explode-img');
    const rect = img.getBoundingClientRect();

    // Clone image
    clone = img.cloneNode(true);
    clone.removeAttribute('id');
    Object.assign(clone.style, {
      position: 'fixed',
      top: `${rect.top}px`,
      left: `${rect.left}px`,
      width: `${rect.width}px`,
      height: `${rect.height}px`,
      zIndex: 9999,
      margin: 0,
    });

    document.body.appendChild(clone);
    img.style.visibility = 'hidden';
  };

  const animateTextLines = () => {
    const allText = [
      document.querySelector('.text-1'),
      document.querySelector('.text-2'),
      document.querySelector('.some-text'),
    ];

    const tl = gsap.timeline({ delay: 1 });

    allText.forEach((textEl) => {
      if (!textEl) return;

      const split = SplitText.create(textEl, { type: 'lines', mask: 'lines' });

      split.lines.forEach((line) => {
        gsap.to(line, {
          y: -150,
          duration: 4,
          ease: 'power2.inOut',
        });
      });
    });

    // Step 2: Zoom in the whole site
    gsap.to('main', {
      scale: 50,
      transformOrigin: '50% 50%',
      duration: 6,
      ease: 'power2.inOut',
    });

    // Step 3: Then expand the clone image to fill the screen
    gsap.to(clone, {
      top: 0,
      left: 0,
      width: window.innerWidth,
      height: window.innerHeight,
      ease: 'power2.inOut',
      duration: 3.5,
    });

    return tl;
  };

  explodeImage(); // Prepare clone first
  animateTextLines(); // Run animation sequence
});
