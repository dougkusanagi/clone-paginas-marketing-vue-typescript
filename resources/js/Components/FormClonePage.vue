<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import axios from "axios";
import { useToast } from "@/components/ui/toast/use-toast";

const { toast } = useToast();
const form = useForm({ url: "https://my.copyblogger.com/" });
const emit = defineEmits(["cloned"]);

async function clone() {
    form.processing = true;

    const response = await axios.post(route("cloned-page.store"), {
        _token: usePage().props.csrf,
        url: form.url,
    });

    form.processing = false;

    if (response.status === 200) {
        return emit("cloned", {
            id: response.data.id,
        });
    }

    toast({
        title: "Ocorreu um erro",
    });
}
</script>

<template>
    <form @submit.prevent="clone">
        <div class="flex items-center space-x-3">
            <Input
                type="text"
                placeholder="Digite ou cole aqui o endereço da página"
                v-model="form.url"
            />

            <Button class="btn btn-info" :disabled="form.processing">
                Clonar
            </Button>
        </div>

        <Label class="mt-3 block">
            O endereço deve começar com http:// ou https://
        </Label>
    </form>
</template>
