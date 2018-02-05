import child from './js/child.js'

console.log(child)

function _a() {
	return new Promise((resolve) => {
		setTimeout(function () {
			resolve(3)
		}, 2000)
	});
}

async function _b() {
	let _v = await _a();
	console.log("_v: ", _v)
	console.log('done123')
}

_b()