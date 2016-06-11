var cityData={
	"":[
		""
	],
	"Shanghai":[
		"",
		"MinHang",
		"HuangPu",
		"PuDong"
	],
	"BeiJing":
	[
		"",
		"HaiDian",
		"ChaoYang"
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