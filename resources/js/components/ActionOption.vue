<template>
    <Popover class="mr-4 w-[100px]">
        <PopoverTrigger>
            <Button variant="link" class="cursor-pointer">
                <Ellipsis />
            </Button>
        </PopoverTrigger>
        <PopoverContent>
            <div class="grid">
                <p class="text-xs text-zinc-400 text-left">Actions</p>
                <Separator />
                <Link :href="props.editLink" variant="ghost" class="text-[#0074B8] text-center my-1 border border-transparent rounded hover:border-slate-200 p-1">
                    Modifier
                </Link>
                <Link as="button" method="delete" :href="props.deleteLink" class="text-red-500 text-center my-1 border border-transparent rounded hover:border-slate-200 p-1" variant="outline" color="red">
                    Supprimer
                </Link>
            </div>
        </PopoverContent>
    </Popover>
</template>

<script setup lang="ts">
import { Ellipsis} from 'lucide-vue-next';
import { Popover, PopoverTrigger, PopoverContent } from '@/components/ui/popover';
import Separator from '@/components/ui/separator/Separator.vue';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    editLink: String,
    deleteLink: String
})

</script>