export default (yearValue, min, max) => ({
    yearValue: yearValue,
    min: min,
    max: max,

    init() {
        var thumbWidth = 20;
        var range = max - min;
        var position = ((this.yearValue - this.min) / range) * 100;
        var positionOffset =
            Math.round((thumbWidth * position) / 100) - thumbWidth / 2;

        this.$refs.bubblesText.style.left = `calc(${position}% - ${positionOffset}px)`;
    },

    bubbles() {
        var thumbWidth = 20;
        var range = max - min;
        var position = ((this.yearValue - this.min) / range) * 100;
        var positionOffset =
            Math.round((thumbWidth * position) / 100) - thumbWidth / 2;

        this.$refs.bubblesText.style.left = `calc(${position}% - ${positionOffset}px)`;
    },
});
