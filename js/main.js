function startTime() {
    const today = new Date();
    const h = today.getHours();
    const m = String(today.getMinutes()).padStart(2, '0');
    const s = String(today.getSeconds()).padStart(2, '0');
    document.getElementById('time-now').innerHTML = `${h}:${m}:${s}`;
}

setInterval(startTime, 1000);

function startDate() {
    const today = new Date();
    const d = today.getDate();
    const m = today.getMonth() + 1;
    const y = today.getFullYear();
    document.getElementById('date-now').innerHTML = `${d}.${m}.${y}`;
}

setInterval(startDate, (60000));

function nameDay() {
    let xhr = new XMLHttpRequest();

    let url = 'https://svatkyapi.cz/api/day';
    xhr.open("GET", url, true);

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let name = JSON.parse(this.responseText).name;
            document.getElementById('name-day').innerHTML = name;
        }
    }
    xhr.send();

}

nameDay();

setInterval(nameDay, (60000*60));

function nowIs() {
    const defaultTimeTable = 'Krátká přestávka';
    const timeTable = {
        'Ráno': ['6:00', '7:50'],
        'První hodina': ['7:50', '8:35'],
        'Druhá hodina': ['8:45', '9:30'],
        'Třetí hodina': ['9:40', '10:25'],
        'Velká přestávka': ['10:25', '10:45'],
        'Čtvrtá hodina': ['10:45', '11:30'],
        'Pátá hodina (První ročník obědová pauza)': ['11:40', '12:00'],
        'Pátá hodina': ['12:00', '12:25'],
        'Obědová pauza (První ročník hodina)': ['12:25', '12:45'],
        'Šestá hodina': ['12:55', '13:40'],
        'Sedmá hodina': ['13:50', '14:35'],
        'Osmá hodina': ['14:45', '15:30'],
        'Devátá hodina': ['15:35', '16:20'],
        'Desátá hodina': ['16:25', '17:00'],
        'Odpoledne': ['17:00', '20:00'],
        'Večer': ['20:00', '22:00'],
        'Noc': ['22:00', '6:00'],
    }
    const now = new Date();
    const h = now.getHours();
    const m = now.getMinutes();
    const nowTime = `${h}:${m}`;

    let nowIs = defaultTimeTable;
    for (const key in timeTable) {
        if (timeTable[key][0] <= nowTime && nowTime < timeTable[key][1]) {
            nowIs = key;
        }
    }
    document.getElementById('now-is').innerHTML = nowIs;
}

startDate();
startTime();
nowIs()
