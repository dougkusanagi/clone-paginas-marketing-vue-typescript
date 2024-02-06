import ShadowDom from "./ShadowDom.js";
import {
    fetchPage,
    normalize_html,
    downloadStringAsFile,
    htmlFromShadowDom,
} from "./utils.js";

document.addEventListener("DOMContentLoaded", async () => {
    const bc = new BroadcastChannel("test_channel");
    const host = document.querySelector("#host");
    const html = await fetchPage({ page: 59 });
    const shadow_dom = new ShadowDom({ host });
    shadow_dom.create(normalize_html(html));

    document.getElementById("saveCopy").addEventListener("click", () => {
        const content = htmlFromShadowDom({ dom: shadow_dom.dom });
        bc.postMessage(content);

        // downloadStringAsFile({ content, filename: "new_index.html" });
    });
});
