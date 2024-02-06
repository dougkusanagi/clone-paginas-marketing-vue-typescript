<script setup>
import { useForm } from "@inertiajs/vue3";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

const form = useForm({ url: "https://my.copyblogger.com/" });
</script>

<template>
    <form @submit.prevent="form.post(route('cloned-page.store'))">
        <div class="flex items-center space-x-3">
            <Input
                type="text"
                placeholder="Digite o endereço do site"
                v-model="form.url"
            />

            <Button class="btn btn-info" :disabled="form.processing">
                Clonar
            </Button>
        </div>

        <Label class="mt-3 block">
            A url deve começar com http:// ou https://
        </Label>
    </form>
</template>
