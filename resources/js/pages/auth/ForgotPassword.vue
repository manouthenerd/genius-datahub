<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout title="Mot de passe oublié" description="Entrer votre email pour recevoir le lien de réintialisation">
        <Head title="Mot de passe oublié" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <div class="space-y-6">
            <Form method="post" :action="route('password.email')" v-slot="{ errors, processing }">
                <div class="grid gap-2">
                    <Label for="email">Adresse email</Label>
                    <Input class="bg-white" id="email" type="email" name="email" autocomplete="off" autofocus placeholder="Votre adresse email" />
                    <InputError :message="errors.email" />
                </div>

                <div class="my-6 flex items-center justify-start">
                    <Button class="w-full bg-[#0168a6] hover:opacity-80 hover:bg-[#0168a6]" :disabled="processing">
                        <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                        Envoyer
                    </Button>
                </div>
            </Form>

            <div class="space-x-1 text-center text-sm text-muted-foreground">
                <span>Retour à la page de</span>
                <TextLink :href="route('login')">connexion</TextLink>
            </div>
        </div>
    </AuthLayout>
</template>
