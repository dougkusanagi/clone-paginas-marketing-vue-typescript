<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

const url = ref("https://my.copyblogger.com/");

function clone() {
    router.post(
        route("cloned-page.store"),
        { url: url.value },
        { onFinish: () => {} }
    );
}
</script>

<template>
    <form @submit.prevent="clone">
        <div class="flex items-center space-x-3">
            <Input
                type="text"
                placeholder="Digite o endereço do site"
                v-model="url"
            />

            <Button class="btn btn-info">Clonar</Button>
        </div>

        <Label class="mt-3 block">
            A url deve começar com http:// ou https://
        </Label>
    </form>
</template>
