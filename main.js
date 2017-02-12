//define class as function-style
let Quick_Loop = function(images, slide){
	let step = 1000;
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

	let run = function(){
		if(typeof images[count] == 'undefined'){
			console.log('End slide loop');
			//reset count
			count = 0;
			return;
		}

		let percent = (images.length - count) / images.length;
		let step = easeInOutCubic(percent) * step;
		// step = step < 200 ? 200 : step ;
		// console.log(step);

		setTimeout(function(){
			requestAnimationFrame(function(){
				slide.style.transition = `all ${step / 4 / 1000}s ease-in-out`;
				slide.style[ANIMATION_IN.name] = ANIMATION_IN.value;
				slide.src = images[count];

				//create a point let it disappear
				setTimeout(function(){
					requestAnimationFrame(function(){
						// console.log('call', ANIMATION_OUT);
						slide.style[ANIMATION_OUT.name] = ANIMATION_OUT.value;
					});
				}, step * 3 / 4);

				count++;
				// console.log(count);
				//continue run
				run();
			});

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
	let slide = document.querySelector('#slide');

	let quick_loop = Quick_Loop(i1, slide);
// quick_loop.run();
	window.addEventListener('click', function(){
		quick_loop.run();
	});
}

//Sanity check ask for images
if(typeof images == 'undefined')
	console.error('Server still not push images to global');
init(images);
