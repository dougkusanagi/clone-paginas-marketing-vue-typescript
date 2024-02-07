import ShadowDom from "./ShadowDom.js";
import {
    fetchPage,
    normalize_html,
    downloadStringAsFile,
    htmlFromShadowDom,
} from "./utils.js";

document.addEventListener("DOMContentLoaded", async () => {
    const host = document.querySelector("#host");
    const html = await fetchPage({ page: 59 });
    const shadow_dom = new ShadowDom({ host });
    shadow_dom.create(normalize_html(html));

    document.getElementById("saveCopy").addEventListener("click", () => {
        const url = window.location.pathname.split("/");
        const id = url[2];

        if (!id) {
            alert("Id não encontrada na URL");
            return;
        }

        const content = htmlFromShadowDom({ dom: shadow_dom.dom });
        const bc = new BroadcastChannel("test_channel");
        bc.postMessage({ content, id });

        // downloadStringAsFile({ content, filename: "new_index.html" });
    });
});
