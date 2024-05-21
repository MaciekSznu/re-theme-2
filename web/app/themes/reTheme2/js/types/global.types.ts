export {};

declare global {
    interface Window {
        sliderBlockIDs: Array<string>;
        slickSliders: Array<JQuerySlick>;
		// Here are just used functions. If you use another, type them here
        acf: { addAction: (params: string, callback: () => void) => void };
    }
}
