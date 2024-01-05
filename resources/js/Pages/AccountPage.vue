<script>
import LayoutComponent from "../Layuot/LayoutComponent.vue";
import Report from "../../Components/Report.vue";

export default {
    components: {
        LayoutComponent,
        Report,
    },
    data() {
        return {
            componentName: "Report",
        };
    },
};
</script>
<template>
    <LayoutComponent>
        <ul class="nav nav-tabs mb-5">
            <li class="nav-item">
                <button
                    class="nav-link"
                    :class="{ active: componentName === 'Report' }"
                >
                    Report
                </button>
            </li>
        </ul>
        <component :is="componentName"></component>
    </LayoutComponent>
</template>
