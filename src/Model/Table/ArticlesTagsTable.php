<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArticlesTags Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsTo $Tags
 *
 * @method \App\Model\Entity\ArticlesTag newEmptyEntity()
 * @method \App\Model\Entity\ArticlesTag newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ArticlesTag> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ArticlesTag get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ArticlesTag findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ArticlesTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ArticlesTag> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ArticlesTag|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ArticlesTag saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ArticlesTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ArticlesTag>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ArticlesTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ArticlesTag> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ArticlesTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ArticlesTag>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ArticlesTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ArticlesTag> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ArticlesTagsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('articles_tags');
        $this->setDisplayField(['article_id', 'tag_id']);
        $this->setPrimaryKey(['article_id', 'tag_id']);

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['article_id'], 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn(['tag_id'], 'Tags'), ['errorField' => 'tag_id']);

        return $rules;
    }
}
