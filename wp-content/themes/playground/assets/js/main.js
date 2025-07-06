import '../css/main.css';

console.log('Tailwind + Vite + WordPress works!');

gsap.registerPlugin(SplitText);

const someText = document.querySelector('.some-text');
if (someText) {
  let splitText = SplitText.create(someText, {
    type: 'chars, words',
    autoSplit: true,
  });

  gsap.from(splitText.chars, {
    duration: 1,
    opacity: 0,
    y: 300,
    ease: 'power2.out',
    stagger: {
      amount: 0.1,
      from: 'random',
      yoyo: true,
    },
  });
  gsap.from(splitText.words, {
    duration: 1,
    opacity: 0,
    x: (i) => 300 + i * 100,
    ease: 'power2.out',
    stagger: {
      amount: 5.1,
      from: 'start',
    },
  });
}
