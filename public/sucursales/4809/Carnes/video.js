function playlist(){
	var gapless = new GaplessPlayback('gaplessPlayer', 'gaplessPlaylist');
	gapless.setContentPath('ipk');
	gapless.addContent('0.mp4', 500);
	gapless.setObjectFit('fill');
	gapless.play();
}