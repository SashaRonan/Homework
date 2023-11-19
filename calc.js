
function calculate() {

    let valueInputX = document.querySelector("#valueX");
    let valueX = valueInputX.value;

    let valueInputY = document.querySelector("#valueY");
    let valueY = valueInputY.value;

    let selectOptionField = document.querySelector("#selectOption");
    let selectOption = selectOptionField.value;

    // console.log(valueX, valueY, selectOption);

    fetch ("calc.php?valueX=" + valueX + "&selectOption=" + selectOption + "&valueY=" + valueY)

        .then (response => response.json())
        .then(jsonObject => {
            //Показываем ответ
            console.dir(jsonObject);

        //
        //     let i;
        //     let resultList = "";
        //
        //     for (i = 0; i < jsonObject.resultArray.length; i++) {
        //         resultList = resultList + jsonObject.resultArray[i].resultExpression + "; "
        //     }
            let resultField = document.querySelector(".lastResult");
            resultField.innerHTML = "Последние результаты: " + jsonObject;
        })
}



