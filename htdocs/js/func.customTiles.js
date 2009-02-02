function CustomTiles(baseUrl, ext, levels){
	function CustomGetTileUrl(tile,zoom) {
		var tilesPerSide = Math.pow(2, zoom);
		if(zoom >= 0 && zoom < levels && tile.x >= 0 && tile.y >= 0 && tile.x < tilesPerSide && tile.y < tilesPerSide){
				var n = tile.y * tilesPerSide + tile.x;
				return baseUrl + "-" + zoom + "-" + n + "." + ext;
		}else{
			return "http://maps.google.com/mapfiles/transparent.gif";
		}
	};
	
	return CustomGetTileUrl;
}