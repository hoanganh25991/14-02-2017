let Sticker_Loop = function(sticker) {
	const step = 144;
	const start = -12;
	const times = 9;
	const loop_time = 100;

	let _animate = function(sticker) {
		setTimeout(function() {
			requestAnimationFrame(function() {
				let x = start - (sticker.loop % 3) * step;
				let y = start - Math.floor(sticker.loop / 3) * step;
				sticker.loop++;

				sticker.style.backgroundPosition = `${x}px ${y}px`;
			});

			//breack condition
			if (sticker.loop == times) {
				console.log('End loop');
				sticker.loop = 0;
				return;
			}

			_animate(sticker);
		}, loop_time);
	};

	let _init = function(sticker) {
		//init loop			
		if (typeof sticker.loop == 'undefined')
			sticker.loop = 0;



		// sticker.addEventListener('mouseover', function() {
		sticker.addEventListener('click', function() {
			console.log('hover');
			_animate(sticker);
		});

	};

	return {
		sticker,
		init: function(){_init(this.sticker);},
		animate: function(){_animate(this.sticker);}
	};
};


//define class as function-style
let Quick_Loop = function(images, slide){
	let f = 1000;
	let count = 0;



	const ANIMATION_OUT = {
		name: 'transform',
		value: 'scale(0, 0)'
	};

	const ANIMATION_IN = {
		name: 'transform',
		value: 'scale(1, 1)'
	};

	let easeInOutCubic = function(x){
		if(x < 0.5){
			return (2 * x * x);

		}else{
			x -= 1;
			return 1 - (2 * x * x);
		}
	};

	//this is the internal event of slide
	//to decide when out
	// slide.addEventListener('load', function(){
	slide.addEventListener('transitionend', function(){
		if(slide.style[ANIMATION_IN.name] == ANIMATION_IN.value){
			let step2 = slide.step;
			console.log('TRANSITIONEND', slide.style[ANIMATION_IN.name], new Date().getTime());
			setTimeout(function(){
				requestAnimationFrame(function(){
					console.log('OUT', new Date().getTime());
					// console.log('call', ANIMATION_OUT);
					slide.style[ANIMATION_OUT.name] = ANIMATION_OUT.value;
				});
			}, step2 * 1 / 2);
		}else{
			console.log('TRANSITIONEND', new Date().getTime());
		}
	});

	slide.addEventListener('load', function(){
		console.log('IN', new Date().getTime());
		let step2 = slide.step;
		//wait for load total effected than change styl
		slide.style.transition = `all ${step2/4/1000}s ease-in-out`;
		slide.style[ANIMATION_IN.name] = ANIMATION_IN.value;
	});

	let run = function(){
		if(typeof images[count] == 'undefined'){
			console.log('End slide loop');
			console.timeEnd('quick_loop');
			let detail = {
				slide,
				say: 'hello world'
			};
			let event = new CustomEvent('quick_loop_end', {detail});
			document.dispatchEvent(event);
			//reset count
			count = 0;
			return;
		}

		let percent = (images.length - count) / images.length;
		let step = easeInOutCubic(percent) * f;
		// step = step < 200 ? 200 : step ;
		// console.log(step);

		setTimeout(function(){
			console.log('LOADDING', new Date().getTime());
			//create a point let it disappear
			let percent2 = (images.length - (count+1)) / images.length;
			let step2 = easeInOutCubic(percent2) * f;

			//update current step to transform-out
			slide.step = step2;

			slide.src = images[count];
			// slide.style.transition = `all ${step2/4/1000}s ease-in-out`;
			// slide.style[ANIMATION_IN.name] = ANIMATION_IN.value;

			count++;
			// console.log(count);
			//continue run
			run();

		}, step);
	};

	return {run};
}

let preload = function(images){
	images.forEach(url =>{
		let i = new Image;
		i.src = url;
	});
	console.log('Image preloaded');
};

//execute preload
let shuffle = function(array){
	let currentIndex = array.length;
	let temporaryValue;
	let randomIndex;

	// While there remain elements to shuffle...
	while(0 !== currentIndex){
		// Pick a remaining element...
		randomIndex = Math.floor(Math.random() * currentIndex);
		currentIndex -= 1;

		// And swap it with the current element.
		temporaryValue = array[currentIndex];
		array[currentIndex] = array[randomIndex];
		array[randomIndex] = temporaryValue;
	}

	return array;
};

let audio;
let quick_loop;
//Run code
let init = function(images){
	let shuffed_images = shuffle(images);

	let i1 = shuffed_images.slice(0, 40);
	preload(i1);

	// audio = new Audio('sound/piano-sonata.mp3');
    audio = document.getElementById('audio');
	//show #tho
	let tho_p = document.querySelector('#tho');
	let control = document.querySelector('#control');
	//show control up
	control.style.opacity = 1;

	control.addEventListener('click', function(e){
		console.log(e);
		let a = e.target;
		if(a.tagName != 'A'){
			window.alert('Bấm vào cái link, con vợ tui, GRUUUU..');
			return;
		}

		let move_step = a.getAttribute('move-step');

		//info read, remove out
		control.remove();

		let tho = 'white';
		if(move_step == 'white')
			tho = 'Hữu duyên thiên lý năng tương ngộ\nVô duyên đối diện đá vêu mồm\nAnh yêu em hok về gian dối\nTình yêu chúng mình vô đối phải hok em\n＼＿ヘ(ᐖ◞)､';
		if(move_step == 'black')
			tho = 'Ước gì em biến thành trâu\nĐể anh là đỉa anh bâu vào đùi\nƯớc gì anh biến thành chầy\nĐể em làm cối anh Giã ngày Giã đêm\nᕕ( ᐛ )ᕗ';

		tho_p.innerHTML = tho.replace(/\n/g, '<br>');

		//run quick loop
		setTimeout(function(){
			console.time('quick_loop');
			//remove out
			tho_p.remove();
			let slide = document.querySelector('#slide');
			quick_loop = Quick_Loop(i1, slide);
			quick_loop.run();

			audio.play();
		}, 5000);
	});

	document.addEventListener('quick_loop_end', function(e){
		console.log(e);

		let say_div = document.querySelector('#say');

		say_div.style.top = 0;
		say_div.style.opacity = 1;

		let ohYeahSticker = document.querySelector('#oh-yeah');
		let s = Sticker_Loop(ohYeahSticker);
		s.init();
		setTimeout(function(){
			s.animate();
		}, 200);
	});
}

//Sanity check ask for images
if(typeof images == 'undefined')
	console.error('Server still not push images to client global');
init(images);