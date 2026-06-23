function dateFormat(date) {
    bulan = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    date = date.split("-");
    return date[2] + " " + bulan[parseInt(date[1]) - 1] + " " + date[0];
}

export default dateFormat;
