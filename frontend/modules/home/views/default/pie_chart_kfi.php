<script>
const data = {
    datasets: [{
        data: [<?=$percentage?> * 100, 100 - percentage * 100], // คำนวณเปอร์เซ็นต์
        backgroundColor: <?=$color?>,
        borderWidth: 0
    }]
};

const options = {
    responsive: true,
    cutoutPercentage: 70, // ลดขนาดของรูตรงกลาง
    plugins: {
        tooltip: {
            enabled: false // ปิด tooltip
        }
    },
    animation: {
        onComplete: function() {
            const width = this.chart.width;
            const height = this.chart.height;
            const ctx = this.chart.ctx;

            ctx.restore();
            ctx.font = "14px Arial"; // ขนาดฟอนต์
            ctx.fillStyle = "#000"; // สีข้อความ
            ctx.textAlign = "center"; // กำหนดให้อยู่กลาง
            ctx.textBaseline = "middle"; // แนวตั้งกลาง

            const centerX = width / 2;
            const centerY = height / 2;

            const percentageText = `${Math.round(percentage * 100)}%`;
            ctx.fillText(percentageText, centerX, centerY);
            ctx.save();
        }
    }
};

return new Chart(ctx, {
    type: 'pie',
    data: data,
    options: options
});
</script>