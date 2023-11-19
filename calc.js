
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
            console.log(jsonObject);


            let i;
            let resultList = "";

            for (i = 0; i < jsonObject.resultExpression.length; i++) {
                resultList = resultList + jsonObject.resultExpression[i] + ";" + "<br>";
            }
            let resultField = document.querySelector(".lastResult");
            resultField.innerHTML = "Последние результаты: <br>" + resultList;
        })
        .catch(err => alert(err));
}



