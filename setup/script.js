
        const btnAdd = document.querySelector('#btnAdd');
        const btnRemove = document.querySelector('#btnRemove');
        const sb = document.querySelector('#list');
        const name = document.querySelector('#name');

        btnAdd.onclick = (e) => {
            e.preventDefault();

            // validate the option
            if (name.value == '') {
                alert('Please enter the property type name.');
                return;
            }
            // create a new option
            const option = new Option(name.value, name.value);
            // add it to the list
            sb.add(option, undefined);

            // reset the value of the input
            name.value = '';
            name.focus();
        };

        // remove selected option
        btnRemove.onclick = (e) => {
            e.preventDefault();

            // save the selected option
            let selected = [];

            for (let i = 0; i < sb.options.length; i++) {
                selected[i] = sb.options[i].selected;
            }

            // remove all selected option
            let index = sb.options.length;
            while (index--) {
                if (selected[index]) {
                    sb.remove(index);
                }
            }
        };
  
        const btnAdd1 = document.querySelector('#btnAdd1');
        const btnRemove1 = document.querySelector('#btnRemove1');
        const sb1 = document.querySelector('#list1');
        const name1 = document.querySelector('#name1');

        btnAdd1.onclick = (e) => {
            e.preventDefault();

            // validate the option
            if (name1.value == '') {
                alert('Please enter the city name.');
                return;
            }
            // create a new option
            const option = new Option(name1.value, name1.value);
            // add it to the list
            sb1.add(option, undefined);

            // reset the value of the input
            name1.value = '';
            name1.focus();
        };

        // remove selected option
        btnRemove1.onclick = (e) => {
            e.preventDefault();

            // save the selected option
            let selected = [];

            for (let i = 0; i < sb1.options.length; i++) {
                selected[i] = sb1.options[i].selected;
            }

            // remove all selected option
            let index = sb1.options.length;
            while (index--) {
                if (selected[index]) {
                    sb1.remove(index);
                }
            }
        };


document.getElementById('form').onsubmit = function(e){
	
	var cities = [];
	 for (let i = 0; i < sb1.options.length; i++) {
        cities.push(sb1.options[i].innerHTML);
    }
	
	var prop_types = [];
	 for (let i = 0; i < sb.options.length; i++) {
        prop_types.push(sb.options[i].innerHTML);
    }
			
	this['cities'].value = cities.join(',');
	this['prop_types'].value = prop_types.join(',');
	
	//event.preventDefault();
}