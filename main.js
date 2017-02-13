//define class as function-style
let Quick_Loop = function(images, slide){
	let f = 1000;
	let count = 0;

	let preload = function(){
		images.forEach(url =>{
			let i = new Image;
			i.src = url;
		})
		;
	}

	//execute preload
	preload();

	const ANIMATION_OUT = {
		name: 'transform',
		value: 'scale(0,0)'
	};

	const ANIMATION_IN = {
		name: 'transform',
		value: 'scale(1,1)'
	};

	let easeInOutCubic = function(x){
		if(x < 0.5){
			return (2 * x * x);

		}else{
			x -= 1;
			return 1 - (2 * x * x);
		}
	};

	slide.addEventListener('load', function(){
		console.log('LOAD', new Date().getTime());
		let step2 = slide.step;
		setTimeout(function(){
			requestAnimationFrame(function(){
				console.log('OUT', new Date().getTime());
				// console.log('call', ANIMATION_OUT);
				slide.style[ANIMATION_OUT.name] = ANIMATION_OUT.value;
			});
		}, step2 * 1 / 2);
	});

	let run = function(){
		if(typeof images[count] == 'undefined'){
			console.log('End slide loop');
			console.time('quick_loop');
			//reset count
			count = 0;
			return;
		}

		let percent = (images.length - count) / images.length;
		let step = easeInOutCubic(percent) * f;
		// step = step < 200 ? 200 : step ;
		// console.log(step);

		setTimeout(function(){
			console.log('IN', new Date().getTime());
			//create a point let it disappear
			let percent2 = (images.length - (count+1)) / images.length;
			let step2 = easeInOutCubic(percent2) * f;

			slide.step = step2;


			slide.src = images[count];
			slide.style.transition = `all ${step2/4/1000}s ease-in-out`;
			slide.style[ANIMATION_IN.name] = ANIMATION_IN.value;

			count++;
			// console.log(count);
			//continue run
			run();

		}, step);
	};

	return {run};
}

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
}


//Run code
let init = function(images){
	let shuffed_images = shuffle(images);

	let i1 = shuffed_images.slice(0, 40);
	console.log(i1);

	let preload = function(images){
		images.forEach(url =>{
			let i = new Image;
			i.src = url;
		})
		;
	}

//execute preload
	preload(i1);
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
			let quick_loop = Quick_Loop(i1, slide);
			quick_loop.run();
		}, 5000);
	});
}

//Sanity check ask for images
if(typeof images == 'undefined')
	console.error('Server still not push images to client global');
init(images);