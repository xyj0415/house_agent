var cityData={
	"":[
		""
	],
	"Shanghai":[
		"",
		"Baoshan",
		"Changning",
		"Chongming",
		"Fengxian",
		"Hongkou",
		"Huangpu",
		"Jiading",
		"Jing'an",
		"Jinshan",
		"Minhang",
		"Pudong",
		"Putuo",
		"Qingpu",
		"Songjiang",
		"Xuhui",
		"Yangpu",
		"Zhabei",
	],
	"Beijing":
	[
		"Changping",
		"ChaoYang",
		"Daxing",
		"Dongcheng",
		"Fangshan",
		"Fengtai",
		"HaiDian",
		"Huairou",
		"Mentougou",
		"Miyun",
		"Pinggu",
		"Shijingshan",
		"Shunyi",
		"Tongzhou",
		"Xicheng",
		"Yanqing",
	]
};

function setSelectOptions(element, options){
	var items=[];
	options.forEach(function(item){
		items.push('<option value="'+item+'">'+item+'</option>');
	});
	element.html(items.join('\n'));
}

$(document).ready(function(){
	var citySelect=$('#city');
	var districtSelect=$('#district');

	function updateDistrict(){
		setSelectOptions(districtSelect,cityData[citySelect.val()]);
	}

	setSelectOptions(citySelect,Object.keys(cityData));

	updateDistrict();

	citySelect.bind('change',updateDistrict)
});