<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useToast } from "@/components/ui/toast/use-toast";

const url = ref("https://my.copyblogger.com/");
const { toast } = useToast();

function clone() {
    router.post(
        route("cloned-page.store"),
        { url: url.value },
        {
            onFinish: () => {
                // console.log("finish");
                // console.log(usePage().props.success);
                // toast({
                //     title: "Scheduled: Catch up",
                //     description: "Friday, February 10, 2023 at 5:57 PM",
                // });
            },
        }
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
