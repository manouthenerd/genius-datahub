<template>
    <Popover class="mr-4 w-[100px]">
        <PopoverTrigger>
            <Button variant="link" class="group cursor-pointer">
                <Ellipsis class="group-hover:stroke-[#0074B8]" />
            </Button>
        </PopoverTrigger>
        <PopoverContent>
            <div class="grid">
                <p class="text-left text-xs text-zinc-400">Actions</p>
                <Separator />
                <Link
                    v-if="props.showEditLink"
                    :href="props.editLink"
                    variant="ghost"
                    class="my-1 rounded border border-transparent p-1 text-center text-[#0074B8] hover:border-slate-200"
                >
                    Modifier
                </Link>
                <Link
                    as="button"
                    v-if="props.showDeleteBtn"
                    method="delete"
                    :href="props.deleteLink"
                    class="my-1 rounded border border-transparent p-1 text-center text-red-500 hover:border-slate-200"
                    variant="outline"
                    color="red"
                >
                    Supprimer
                </Link>
            </div>
        </PopoverContent>
    </Popover>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import Separator from '@/components/ui/separator/Separator.vue';
import { Link } from '@inertiajs/vue3';
import { Ellipsis } from 'lucide-vue-next';

const props = defineProps({
    editLink: String,
    deleteLink: String,
    showEditLink: {
        type: Boolean,
        default: true,
    },
    showDeleteBtn: {
        type: Boolean,
        default: true,
    },
    showDialogButton: {
        type: Boolean,
        default: false,
    },
    serviceName: String,
});
</script>
