use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {

            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('en_attente');

            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('cin')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();

            $table->string('priority')->default('normal');
        });
    }

    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropColumn([
                'type','description','status',
                'full_name','phone','cin',
                'address','city','priority'
            ]);
        });
    }
};