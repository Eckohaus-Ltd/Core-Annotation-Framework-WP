/**
 * Plotly Renderer — default
 */

const EckohausPlotlyRenderer = {
    render(data) {
        const container = document.getElementById("eckohaus-vol-container");

        const volume = {
            type: "volume",
            value: data.values || [],
            x: data.x || [],
            y: data.y || [],
            z: data.z || [],
            opacity: 0.3,
            surface: { show: true }
        };

        Plotly.newPlot(container, [volume], {
            scene: { aspectmode: "cube" }
        });
    }
};
